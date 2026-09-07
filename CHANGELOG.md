# Changelog

## 0.1.0

### Added
- Canonical `Kumwe\BusinessPolicy` ownership of 14 extracted policy/disclosure/access-plan types.
- Bounded AST validation, schema references, deny-overrides evaluation, precise decimals and temporal semantics.
- Package-owned behavior/boundary tests, a language-neutral semantic corpus and fixed canonical-byte fixtures.
- Complete public API, capability/service manifests, direct-construction examples and Phase 2 handoff.
- Strict package, archive, clean-consumer and hardened release-on-record gates.

### Corrected before initial release
- Compare decimal digits lexically without numeric-string floating-point coercion.
- Reject over-complex and foreign/cyclic boolean children during construction.
- Reject malformed explicit disclosure lists and invalid UTF-8 literals deterministically.

### Ownership
- App retains final authority, active policy selection, loading, database compilation and delivery.
- SDK/App adoption requires separate release verification and remains pending. NRM-2026-022.
