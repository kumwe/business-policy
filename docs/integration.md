# Core and host integration

Business Policy supplies reusable policy semantics. Core, the Kumwe App and other hosts own authority and runtime composition. Package CI verifies this library; consumers verify their own integration and deployment.

Construct immutable schemas, predicates, sets and disclosure/access plans from already-authorized host data. `RecordPolicyEvaluator` has no injected collaborators and needs no container registration. Hosts may directly construct it or inject their own shared instance; it captures no actor, tenant, request, policy or transaction. No service aliases, configuration keys or factories are exported.

Keep the host's selected policy revision and every effective authority input in its authorization fingerprint. Durable fingerprints bind approval, membership, policy revision and effective authority while excluding only replaceable worker credentials. Compute both from host-owned normalized evidence. This library does not validate memberships, approve queued work or infer authority from a hash.

The host query compiler consumes the validated schema/AST, applying predicates before pagination, counts, aggregates, reports and exports. Apply each explicit field permission to its exact use. Detail visibility does not imply filter, sort, search, aggregate, relation, include, public-reference or export permission. Evaluate related plans independently when the host authorizes traversal. Do not fetch broad result sets and use the evaluator as a post-load security filter.

## Dependency and compatibility contract

Independently verify the exact immutable package source, Composer archive, public manifests and external release attestation before adopting a version. Pin pre-1.0 releases exactly. When a consumer also uses Extension SDK, its SDK release must use the same canonical Business Policy types. Dependency installation alone does not prove compatibility or authorization.

The [release record](release-record.md) retains baseline source-to-package symbol mappings, consumer paths, dependency-injection requirements and manifest digests for machine verification. Those paths identify the recorded compatibility baseline; compare them with the consumer's current source before changing imports or deleting duplicate implementation code. Keep newer portable behavior in this package and preserve host authority, adapters and workflows.

## Test ownership

| Owner | Required coverage |
| --- | --- |
| Business Policy | AST and value behavior, hostile input and complexity boundaries, scalar semantics, disclosure usages, immutable access plans, canonical corpus, public API, direct construction and archive installation. |
| Core and consuming applications | Trusted context construction, final authorization, query leakage, pagination/count/aggregate/report/export restrictions, policy-change races, tenant/site/organization isolation, persistence, transaction atomicity, concurrency, recovery, adapters and direct-service security. |

Consumers use package behavior through its public API and keep their composed integration tests. When replacing an in-tree implementation, remove only the duplicate portable behavior assertions; retain host-contract assertions even when they share a test file. Confirm old namespaces are absent from source, configuration, factories, reflection strings, fixtures and examples. Re-run the consumer's affected unit and integration suites after dependency or API changes.
