# Business Policy

`kumwe/business-policy` owns a bounded record-policy AST, deterministic evaluation, field disclosure and immutable access plans under `Kumwe\BusinessPolicy`.

PHP 8.5 and `ext-json` are required. No third-party runtime dependencies are needed. Install a separately verified immutable release with Composer; pre-1.0 consumers pin its exact version. This extraction candidate is not release verification.

```php
use Kumwe\BusinessPolicy\Policy\RecordPolicyConstant;
use Kumwe\BusinessPolicy\Policy\RecordPolicySchema;
use Kumwe\BusinessPolicy\Policy\RecordPolicySet;
use Kumwe\BusinessPolicy\Application\FieldAccessUsage;
use Kumwe\BusinessPolicy\Application\FieldDisclosurePlan;

$policy = new RecordPolicySet(new RecordPolicySchema([]), [new RecordPolicyConstant(true)]);
$fields = new FieldDisclosurePlan(['list' => ['name']]);
$policy->allows([]); // true: an allow matched and no deny matched
$fields->allows(FieldAccessUsage::Export, 'name'); // false: uses are independent
```

Run the complete standalone example with `composer examples`. Empty allow sets deny; matching denies override allows. Missing fields act as null. Empty disclosure sets disclose no fields. Constructors reject invalid grammar, references, types and complexity through `InvalidArgumentException`; JSON encoding can raise `JsonException`. Decimal comparisons use exact digits, never floating-point coercion. Immutable values and the stateless evaluator are reusable across requests; the caller supplies values and authority for each operation.

There is no ConfigProvider: values are directly constructed, and `RecordPolicyEvaluator` has no collaborators, configuration or mutable state. There are no factories, aliases, registries or injected services. The predicate interface describes a closed grammar; custom implementations cannot add operators.

App retains active policy selection, actor/resource loading, final allow/deny/step-up decisions, query compilation, transactions, audit and delivery. In-memory evaluation is a semantic facility: hosts constrain queries before counts, paging, aggregates, reports and exports. An access plan records host authority; constructing one does not authorize a caller.

See [the complete public API](docs/public-api.md), [architecture and serialization](docs/architecture.md), [host integration](docs/integration.md), [compatibility and security](docs/security-compatibility.md), and [migration handoff](MIGRATION-HANDOFF.md). The [language-neutral corpus](resources/policy-corpus/v1.json) preserves semantics for future implementations.

```sh
composer install
composer check
```

The gate runs syntax, PSR-12, maximum-level static analysis, behavior and hostile-input tests, API and architecture drift checks, dependency security audit, release automation tests, and a fresh no-dev, authoritative-classmap install from the verified Composer ZIP. CI targets PHP 8.5 on Linux. Archive consumers require only PHP and JSON; ZIP is required by the development archive gate.

Release automation reads the first numbered changelog record only after the complete default-branch gate succeeds. Human review and merge precede publication; an external release attestation precedes SDK/App adoption. This work does not remove App/SDK implementations. Apache-2.0; see LICENSE.
