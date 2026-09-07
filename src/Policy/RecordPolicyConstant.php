<?php

declare(strict_types=1);

namespace Kumwe\BusinessPolicy\Policy;

use Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate;

/**
 * Explicit true or false leaf used when a policy intentionally covers every or no record.
 *
 * @since  0.1.0
 */
final readonly class RecordPolicyConstant implements RecordPolicyPredicate
{
    /**
     * Create an explicit constant policy leaf.
     *
     * @param  bool  $value  Truth value this leaf always produces.
     *
     * @since  0.1.0
     */
    public function __construct(public bool $value)
    {
    }

    /**
     * Return the deterministic constant document used for policy digests.
     *
     * @return  array<string, mixed>  Canonical constant predicate document.
     *
     * @since   0.1.0
     */
    public function toArray(): array
    {
        return ['type' => 'constant', 'value' => $this->value];
    }

    /**
     * Count this leaf as one policy operation.
     *
     * @return  int  Always one.
     *
     * @since   0.1.0
     */
    public function operationCount(): int
    {
        return 1;
    }

    /**
     * Measure this leaf as a one-level tree.
     *
     * @return  int  Always one.
     *
     * @since   0.1.0
     */
    public function depth(): int
    {
        return 1;
    }
}
