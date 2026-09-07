<?php

declare(strict_types=1);

namespace Kumwe\BusinessPolicy\Tests;

use InvalidArgumentException;
use Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan;
use Kumwe\BusinessPolicy\Application\FieldAccessUsage;
use Kumwe\BusinessPolicy\Application\FieldDisclosurePlan;
use Kumwe\BusinessPolicy\Policy\RecordPolicyBoolean;
use Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparison;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator;
use Kumwe\BusinessPolicy\Policy\RecordPolicyConstant;
use Kumwe\BusinessPolicy\Policy\RecordPolicyEvaluator;
use Kumwe\BusinessPolicy\Policy\RecordPolicyNullCheck;
use Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate;
use Kumwe\BusinessPolicy\Policy\RecordPolicySchema;
use Kumwe\BusinessPolicy\Policy\RecordPolicySet;
use Kumwe\BusinessPolicy\Policy\RecordPolicyValueType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PolicyBoundaryTest extends TestCase
{
    #[DataProvider('invalidLiterals')]
    public function testInvalidLiteralsAreRejected(string $type, mixed $literal): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RecordPolicyComparison('value', RecordPolicyComparisonOperator::Equal, RecordPolicyValueType::from($type), $literal);
    }

    public static function invalidLiterals(): iterable
    {
        foreach (['2026-13-40', '2026-02-30', '25:00:00', '12:30:00.1', '0999-01-01', '2026-01-01T00:00:00Z', '2026-01-01T00:00:00.000000+00:00'] as $literal) {
            yield 'temporal ' . $literal => ['temporal', $literal];
        }
        foreach (['01', '+1', '1e3', '1.', '.1', 'NaN', ' 1', '1\n'] as $literal) {
            yield 'decimal ' . $literal => ['decimal', $literal];
        }
        yield 'string is exact' => ['string', 1];
        yield 'integer is exact' => ['integer', '1'];
        yield 'boolean is exact' => ['boolean', 1];
        yield 'decimal is text' => ['decimal', 1];
        yield 'oversized' => ['string', str_repeat('a', 4097)];
        yield 'invalid UTF-8' => ['string', "\xff"];
    }

    public function testBoundsAdmitTheirExactLimits(): void
    {
        $literal = new RecordPolicyComparison(str_repeat('a', 63), RecordPolicyComparisonOperator::Equal, RecordPolicyValueType::String, str_repeat('x', 4096));
        self::assertSame(1, $literal->depth());
        $leaf = new RecordPolicyConstant(true);
        $policy = new RecordPolicySet(new RecordPolicySchema([]), array_fill(0, 32, $leaf), array_fill(0, 32, $leaf));
        self::assertFalse($policy->allows([]));
        $node = $leaf;
        for ($index = 1; $index < 8; ++$index) {
            $node = new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, [$node]);
        }
        self::assertSame(8, $node->depth());
        self::assertSame(8, $node->operationCount());
        self::assertTrue((new RecordPolicySet(new RecordPolicySchema([]), [$node]))->allows([]));
    }

    #[DataProvider('invalidStructures')]
    public function testHostileStructuresAreRejected(callable $construct): void
    {
        $this->expectException(InvalidArgumentException::class);
        $construct();
    }

    public static function invalidStructures(): iterable
    {
        $leaf = new RecordPolicyConstant(true);
        yield 'empty children' => [static fn () => new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, [])];
        yield '17 children' => [static fn () => new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, array_fill(0, 17, $leaf))];
        yield 'associative children' => [static fn () => new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, ['a' => $leaf])];
        yield 'wrong child type' => [static fn () => new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, ['true'])];
        yield '33 allows' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), array_fill(0, 33, $leaf))];
        yield '33 denies' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), [], array_fill(0, 33, $leaf))];
        yield 'associative allows' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), ['a' => $leaf])];
        yield 'unknown comparison field' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), [new RecordPolicyComparison('absent', RecordPolicyComparisonOperator::Equal, RecordPolicyValueType::Integer, 1)])];
        yield 'unknown null field' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), [new RecordPolicyNullCheck('absent')])];
        yield 'unknown schema type' => [static fn () => new RecordPolicySchema(['value' => 'integer'])];
        yield 'numeric schema key' => [static fn () => new RecordPolicySchema([RecordPolicyValueType::Integer])];
        yield 'invalid field handle' => [static fn () => new RecordPolicyNullCheck('Value')];
        yield 'string ordering' => [static fn () => new RecordPolicyComparison('value', RecordPolicyComparisonOperator::LessThan, RecordPolicyValueType::String, 'a')];
        yield 'boolean ordering' => [static fn () => new RecordPolicyComparison('value', RecordPolicyComparisonOperator::GreaterThan, RecordPolicyValueType::Boolean, true)];
        yield 'unknown usage' => [static fn () => new FieldDisclosurePlan(['unknown' => ['name']])];
        yield 'null disclosure list' => [static fn () => new FieldDisclosurePlan(['detail' => null])];
        yield 'associative disclosure' => [static fn () => new FieldDisclosurePlan(['detail' => ['a' => 'name']])];
        yield '257 fields' => [static fn () => new FieldDisclosurePlan(['detail' => array_fill(0, 257, 'name')])];
        yield 'bad disclosed field' => [static fn () => new FieldDisclosurePlan(['detail' => ['Name']])];
        yield 'too many operations across sets' => [static fn () => new RecordPolicySet(new RecordPolicySchema([]), array_fill(0, 32, new RecordPolicyBoolean(RecordPolicyBooleanOperator::Any, [$leaf])), [$leaf])];
    }

    public function testCustomCyclicPredicatesAreRefusedWithoutExecutingTheirMethods(): void
    {
        $node = new class implements RecordPolicyPredicate {
            public RecordPolicyPredicate $child;
            public function toArray(): array { throw new \LogicException('Untrusted method ran'); }
            public function operationCount(): int { throw new \LogicException('Untrusted method ran'); }
            public function depth(): int { throw new \LogicException('Untrusted method ran'); }
        };
        $node->child = $node;
        self::assertFalse((new RecordPolicyEvaluator())->evaluate($node, []));
        foreach ([
            static fn () => new RecordPolicyBoolean(RecordPolicyBooleanOperator::All, [$node]),
            static fn () => new RecordPolicySet(new RecordPolicySchema([]), [$node]),
        ] as $construct) {
            try {
                $construct();
                self::fail('An extension cannot extend the closed grammar.');
            } catch (InvalidArgumentException) {
                self::assertTrue(true);
            }
        }
    }

    public function testEveryDisclosureUsageIsIndependentAndCanonical(): void
    {
        foreach (FieldAccessUsage::cases() as $selected) {
            $fields = new FieldDisclosurePlan([$selected->value => ['z', 'a', 'z']]);
            foreach (FieldAccessUsage::cases() as $usage) {
                self::assertSame($usage === $selected, $fields->allows($usage, 'a'));
                self::assertSame($usage === $selected ? ['a', 'z'] : [], $fields->fields($usage));
            }
            self::assertCount(15, $fields->toArray());
        }
    }

    public function testPlanCanonicalizationActionsAndRelationDepth(): void
    {
        $build = static fn (array $related = [], array $actions = []) => new BusinessRecordAccessPlan('record:1', 'record.read', new RecordPolicySet(new RecordPolicySchema([])), new FieldDisclosurePlan(), str_repeat('a', 64), $related, $actions);
        $leaf = $build();
        $first = $build(['z' => $leaf, 'a' => $leaf], ['z', 'a', 'z']);
        $second = $build(['a' => $leaf, 'z' => $leaf], ['a', 'z']);
        self::assertSame($first->digest(), $second->digest());
        self::assertTrue($first->allowsAction('a'));
        self::assertFalse($first->allowsAction('missing'));
        self::assertNull($first->related('missing'));
        self::assertSame($leaf, $first->related('a'));
        $twoHops = $build(['child' => $first]);
        self::assertSame($first, $twoHops->related('child'));
        $this->expectException(InvalidArgumentException::class);
        $build(['child' => $twoHops]);
    }
}
