<?php

declare(strict_types=1);

use Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan;
use Kumwe\BusinessPolicy\Application\FieldAccessUsage;
use Kumwe\BusinessPolicy\Application\FieldDisclosurePlan;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparison;
use Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator;
use Kumwe\BusinessPolicy\Policy\RecordPolicySchema;
use Kumwe\BusinessPolicy\Policy\RecordPolicySet;
use Kumwe\BusinessPolicy\Policy\RecordPolicyValueType;

require $argv[1] ?? dirname(__DIR__) . '/vendor/autoload.php';

$policy = new RecordPolicySet(
    new RecordPolicySchema(['status' => RecordPolicyValueType::String]),
    [new RecordPolicyComparison('status', RecordPolicyComparisonOperator::Equal, RecordPolicyValueType::String, 'ready')],
    [new RecordPolicyComparison('status', RecordPolicyComparisonOperator::Equal, RecordPolicyValueType::String, 'blocked')],
);
$plan = new BusinessRecordAccessPlan(
    'records:orders',
    'record.read',
    $policy,
    new FieldDisclosurePlan(['list' => ['status']]),
    hash('sha256', 'example-host-supplied-authority-and-policy-revision'),
);
// This is a semantic example. The host applies row constraints in its database query.
if (!$policy->allows(['status' => 'ready']) || $policy->allows(['status' => 'blocked'])) {
    throw new RuntimeException('Policy semantics failed.');
}
if (!$plan->fields->allows(FieldAccessUsage::List, 'status') || $plan->fields->allows(FieldAccessUsage::Export, 'status')) {
    throw new RuntimeException('Field usage isolation failed.');
}
echo "Policy example passed; host-owned authority remains required.\n";
