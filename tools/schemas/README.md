# Package manifest schemas

These authoritative v1 capability and service-map schema snapshots come from
kumwe/app commit 24ecf956423c18933e824b43cea1bfb9127a79a9, under
`docs/architecture/governance/schemas`. The package gate executes their complete
keyword subset locally, verifies exported symbols, document links and actual
provider mappings, and verifies release-record manifest digests and contract sections.

The durable `docs/release-record.md` uses `kumwe-package-release-record/v1` and
retains source-to-package mappings, DI requirements, consumer test ownership and
manifest digests. Consumer verification repeats schema validation against its
supported protocol; package checks require no consumer checkout. Public API
reflection remains the source of truth for exact signatures and source ownership.
