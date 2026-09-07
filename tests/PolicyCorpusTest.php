<?php

declare(strict_types=1);

namespace Kumwe\BusinessPolicy\Tests;

use Kumwe\BusinessPolicy\Policy\RecordPolicyBoolean;
use Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparison;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator;
use Kumwe\BusinessPolicy\Policy\RecordPolicyConstant;
use Kumwe\BusinessPolicy\Policy\RecordPolicyNullCheck;
use Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate;
use Kumwe\BusinessPolicy\Policy\RecordPolicySchema;
use Kumwe\BusinessPolicy\Policy\RecordPolicySet;
use Kumwe\BusinessPolicy\Policy\RecordPolicyValueType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PolicyCorpusTest extends TestCase
{
    public function testCanonicalBytesMatchTheFixedLanguageNeutralFixture(): void
    {
        $fixture = json_decode(file_get_contents(__DIR__ . '/../resources/policy-corpus/canonical-v1.json'), true, 512, JSON_THROW_ON_ERROR);
        $document = $fixture['document'];
        $policy = new RecordPolicySet(
            new RecordPolicySchema(array_reverse(array_map(RecordPolicyValueType::from(...), $document['schema']), true)),
            array_reverse(array_map(self::predicate(...), $document['allows'])),
            array_map(self::predicate(...), $document['denies']),
        );
        $bytes = json_encode($policy->toArray(), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        self::assertSame($fixture['json'], $bytes);
        self::assertSame($fixture['sha256'], hash('sha256', $bytes));
    }

    #[DataProvider('vectors')]
    public function testLanguageNeutralVector(array $vector): void
    {
        $schema = new RecordPolicySchema(array_map(RecordPolicyValueType::from(...), $vector['schema']));
        $allows = array_map(self::predicate(...), $vector['allows']);
        $denies = array_map(self::predicate(...), $vector['denies']);
        $policy = new RecordPolicySet($schema, $allows, $denies);
        self::assertSame($vector['expected'], $policy->allows($vector['values']));
        $permuted = new RecordPolicySet($schema, array_reverse($allows), array_reverse($denies));
        self::assertSame($policy->toArray(), $permuted->toArray());
        self::assertSame($vector['expected'], $permuted->allows($vector['values']));
    }

    public static function vectors(): iterable
    {
        $corpus = json_decode(file_get_contents(__DIR__ . '/../resources/policy-corpus/v1.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($corpus['cases'] as $vector) {
            yield $vector['id'] => [$vector];
        }
    }

    private static function predicate(array $document): RecordPolicyPredicate
    {
        return match ($document['type']) {
            'constant' => new RecordPolicyConstant($document['value']),
            'null_check' => new RecordPolicyNullCheck($document['field'], $document['is_null']),
            'boolean' => new RecordPolicyBoolean(RecordPolicyBooleanOperator::from($document['operator']), array_map(self::predicate(...), $document['children'])),
            'comparison' => new RecordPolicyComparison($document['field'], RecordPolicyComparisonOperator::from($document['operator']), RecordPolicyValueType::from($document['value_type']), $document['value']),
        };
    }
}
