# Business Policy

[![Packagist version](https://img.shields.io/packagist/v/kumwe/business-policy)](https://packagist.org/packages/kumwe/business-policy)
[![CI](https://github.com/kumwe/business-policy/actions/workflows/ci.yml/badge.svg?branch=main&event=push)](https://github.com/kumwe/business-policy/actions/workflows/ci.yml)
[![PHP requirement](https://img.shields.io/packagist/php-v/kumwe/business-policy)](composer.json)
[![License](https://img.shields.io/packagist/l/kumwe/business-policy)](LICENSE)

`kumwe/business-policy` owns a bounded record-policy AST, deterministic evaluation, field disclosure and immutable access plans under `Kumwe\BusinessPolicy`.

## Installation

Requires 64-bit PHP 8.5 and `ext-json`. There are no third-party runtime dependencies.
Pre-1.0 consumers pin an exact release and verify it before adoption:

```sh
composer require kumwe/business-policy:0.1.1
```

The version badge links to published packages. The CI badge reports the default-branch
quality gate; it does not attest a release or a consumer's Core integration.

## Usage

```php
require 'vendor/autoload.php';

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

## Core contract

Core and other consuming applications retain active policy selection, actor/resource loading, final allow/deny/step-up decisions, query compilation, transactions, audit and delivery. In-memory evaluation is a semantic facility: hosts constrain queries before counts, paging, aggregates, reports and exports. An access plan records host authority; constructing one does not authorize a caller.

See [the complete public API](docs/public-api.md), [architecture and serialization](docs/architecture.md), [Core and host integration](docs/integration.md), and [compatibility and security](docs/security-compatibility.md). The [language-neutral corpus](resources/policy-corpus/v1.json) preserves semantics for other implementations. Machine-readable API, capability and service-map identities are bound by the [release record](docs/release-record.md).

## Development

```sh
composer install
composer check
```

The gate runs syntax, PSR-12, maximum-level static analysis, behavior and hostile-input tests, API and architecture drift checks, dependency security audit, release automation tests, and a fresh no-dev, authoritative-classmap install from the verified Composer ZIP. CI targets PHP 8.5 on Linux. Archive consumers require only PHP and JSON; ZIP is required by the development archive gate.

## Releases and compatibility

Release automation reads the first numbered [changelog](CHANGELOG.md) record only after the complete default-branch gate succeeds. Published tags remain fixed. Consumers independently verify the exact release, archive and manifests before adopting it; see the [release standard](docs/package-release-standard.md) and [release record](docs/release-record.md). Source changes on `main` are not added to an existing release.

Licensed under [Apache-2.0](LICENSE).
