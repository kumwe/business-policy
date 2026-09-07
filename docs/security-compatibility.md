# Security and compatibility

Supported runtime: 64-bit PHP 8.5 with JSON. CI uses Linux/PHP 8.5. No native extension, service manager, database or external Kumwe dependency is needed. Local verification records its exact patch version; other platforms are not claimed as tested by that result.

Pre-1.0 consumers pin an exact verified release. Public signatures, semantic corpus, serialization profile and digest inputs are compatibility contracts. A change to authority meaning, grammar, comparison semantics or serialized bytes requires an explicit reviewed decision and a new version. Source `@since` annotations use this package's `0.1.0` identity, not App's historical version.

Initial extraction corrections: decimal comparison uses lexical digit comparison to prevent PHP float coercion; boolean trees reject excess complexity during construction; foreign/cyclic predicate implementations are rejected before callbacks; malformed explicit disclosure lists and invalid UTF-8 literals fail construction. Existing correct inputs retain behavior. Resource identity accepts a portable stable string in place of an App UUID type, and decimal values accept normalized strings/Stringable in place of an App-specific decimal class. This does not substitute for host identity or authority validation.

Report suspected security issues privately to the repository maintainers through GitHub's private vulnerability reporting channel if available; otherwise request a private contact without disclosing exploit details in a public issue. Dependency audit fails on known advisories or abandoned packages. Only host-approved normalized values belong in evaluation; untrusted objects with callable methods are outside the input contract. Constructor-bypassing object restoration is unsupported.

The Apache-2.0 license is retained. Release-on-record runs after the default-branch gate, validates dependency attestations when dependencies exist, and refuses inconsistent records or immutable existing tags. Publication alone does not authorize adoption: the later external verification session attests exact tag/source/archive/manifest identities and a clean consumer install.
