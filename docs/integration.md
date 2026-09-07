# Host integration

Construct immutable schemas, predicates, sets and disclosure/access plans from already-authorized host data. `RecordPolicyEvaluator` has no injected collaborators and needs no container registration. Hosts may directly construct it or inject their own shared instance; it captures no actor, tenant, request, policy or transaction. No service aliases, configuration keys or factories are exported.

Keep the host's selected policy revision and every effective authority input in its authorization fingerprint. Durable fingerprints bind approval, membership, policy revision and effective authority while excluding only replaceable worker credentials. Compute both from host-owned normalized evidence. This library does not validate memberships, approve queued work or infer authority from a hash.

The host query compiler consumes the validated schema/AST, applying predicates before pagination, counts, aggregates, reports and exports. Apply each explicit field permission to its exact use. Detail visibility does not imply filter, sort, search, aggregate, relation, include, public-reference or export permission. Evaluate related plans independently when the host authorizes traversal. Do not fetch broad result sets and use the evaluator as a post-load security filter.

For App and Extension SDK replacement, first independently verify the immutable release, shipped handoff and external release attestation. Update the SDK downward dependency and remove its duplicate types; release and verify that SDK change before coordinated App adoption. Update all App imports/DI type hints, remove only implementation-owned unit tests, and preserve query leakage, pagination/count/aggregate/report/export, policy-change race, tenant/site/organization, adapter and direct-service security integration coverage.

See the file-by-file [handoff](../MIGRATION-HANDOFF.md). Phase 1 neither changes App nor proves the host integration train. A green package test cannot advance roadmap completion by itself.
