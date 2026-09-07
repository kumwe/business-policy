# Public API

Runtime strings use the same valid-UTF-8 and 4096-byte domain as literals. Malformed or oversized runtime strings make every comparison false, including inequality. Access-plan operation names are limited to 127 bytes.

The namespace is `Kumwe\BusinessPolicy`. The [machine-readable manifest](../resources/public-api/v1.json) inventories every stable type, method, property and enum. This document carries their source contracts. Constructors use PHP's declared argument types: wrong runtime argument types raise `TypeError`; grammar, shape, bounds and reference violations raise `InvalidArgumentException` as documented below. Enum `from(string)` raises `ValueError` for an unknown backing value; `tryFrom(string)` returns null; `cases()` returns all cases in declaration order.

Value classes are final and readonly, the evaluator is final and stateless, and returned arrays are independent values. No method starts a transaction, loads records, logs, performs IO, persists data or chooses effective authority. Instances have no request/process-global state and can be safely reused with separately supplied inputs. The only external callbacks are a supplied `Stringable::__toString()` and methods on supplied `DateTimeImmutable` objects; exceptions from those trusted normalized values propagate. Constructor-bypassing restoration is unsupported.

Missing fields and explicit null both match is-null checks, and neither matches any comparison, including inequality. An empty allow set denies; any matching deny overrides every allow. The predicate interface is a closed grammar contract, not an extension hook. Foreign predicate implementations are rejected by constructors and evaluate false when submitted directly to the evaluator.

Decimals accept canonical base-ten strings or actual Stringable values, never floats. The grammar is `-?(0|[1-9][0-9]*)(\.[0-9]+)?`, limited to 4096 bytes. Exact digit comparison normalizes trailing zeros and negative zero for evaluation while preserving literal spelling in serialization. Strings require valid UTF-8, use exact byte equality, and never gain numeric equality by coercion. Integers use the supported 64-bit runtime range. String/boolean literals allow equality/inequality only.

Temporal literals must be real calendar dates `YYYY-MM-DD` (years 1000–9999), local times `HH:MM:SS` or `HH:MM:SS.uuuuuu`, or UTC instants `YYYY-MM-DDTHH:MM:SS.uuuuuuZ`. Actual values are DateTimeImmutable or exact `YYYY-MM-DDTHH:MM:SS.uuuuuu+HH:MM` strings. Dates/times compare the actual local date/time; instants normalize to UTC. Whole seconds require zero microseconds. Invalid calendar values do not match.

Field handles match `[a-z][a-z0-9_]{0,62}`. Schemas contain at most 256 fields; boolean nodes have 1–16 children, tree depth at most 8 and at most 64 operations. Policy sets admit 32 allows and 32 denies with at most 64 operations combined. Field disclosure permits up to 256 entries per independent usage; omitted usages mean empty, never all. Explicit null usage lists are invalid.

Access-plan resource identifiers match `[a-z0-9][a-z0-9._:-]{0,190}`; the host validates resource identity. Operations are lowercase dotted names with at least two segments. Fingerprints are 64 lowercase hexadecimal characters. Relations map at most 384 handles to existing plans and permit at most two hops. Actions contain at most 64 handles, sorted and deduplicated. The durable fingerprint defaults to the ordinary fingerprint; a host must establish unchanged approved authority before excluding replaceable credentials from it.

For canonical member order, empty-map encoding, precision and digest details, see [architecture](architecture.md). `digest()` hashes the ordinary plan document; `durableDigest()` substitutes the durable fingerprint at every related node. Both return lowercase SHA-256 and contain no self-referential digest field.

## `Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan`

| Public property | Type | Mutability |
|---|---|---|
| `authorizationFingerprint` | `string` | readonly |
| `fields` | `Kumwe\BusinessPolicy\Application\FieldDisclosurePlan` | readonly |
| `operation` | `string` | readonly |
| `records` | `Kumwe\BusinessPolicy\Policy\RecordPolicySet` | readonly |
| `resourceIdentifier` | `string` | readonly |

### `__construct`

`__construct(string $resourceIdentifier, string $operation, Kumwe\BusinessPolicy\Policy\RecordPolicySet $records, Kumwe\BusinessPolicy\Application\FieldDisclosurePlan $fields, string $authorizationFingerprint, array $related (optional), array $actions (optional), ?string $durableAuthorizationFingerprint (optional))`

```text
@param   string               $resourceIdentifier               Stable resource identifier this plan protects.
@param   string               $operation                        Dotted operation identifier being authorized.
@param   RecordPolicySet      $records                          Bounded row policy with default-deny semantics.
@param   FieldDisclosurePlan  $fields                           Explicit per-use field permissions.
@param   string               $authorizationFingerprint         Digest of actor, organization, membership
         and policy epoch.
@param array<string, self> $related Target plans keyed by relation or reference handle.
@param   list<string>         $actions                          Action handles explicitly permitted on
         matching rows.
@param   ?string              $durableAuthorizationFingerprint  Credential-independent authority and
         policy digest for queued work; defaults to the strict authorization fingerprint.

@throws  InvalidArgumentException  When identifiers, fingerprints, relations, actions, or graph
         bounds are invalid.
@throws  JsonException  When the canonical plan document cannot be encoded.

@since   0.1.0
```

### `allowsAction`

`allowsAction(string $action): bool`

```text
Report whether an action handle is explicitly admitted by this plan.

@param   string  $action  Declared business action handle.

@return  bool  True only for a listed action.

@since   0.1.0
```

### `digest`

`digest(): string`

```text
Return the stable digest binding cursors and replay to this authorization decision.

@return  string  Lowercase SHA-256 digest.

@since   0.1.0
```

### `durableDigest`

`durableDigest(): string`

```text
Return the credential-independent, approval-bound digest for durable queued work.

Unlike the ordinary digest used by interactive cursors and replays, this digest survives worker
credential rehydration. It still binds the exact effective authority, policy identities, row and
field decisions, actions, and recursively resolved related plans.

@return  string  Lowercase SHA-256 digest.

@since   0.1.0
```

### `related`

`related(string $handle): ?Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan`

```text
Return the target access plan for a relation or entity-reference handle.

@param   string  $handle  Declared source field or relationship handle.

@return  self|null  Explicit target plan, or null when traversal is denied.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the canonical plan document without its derived digest.

@return  array<string, mixed>  Deterministic authorization decision.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Application\FieldAccessUsage`

| Case | Value |
|---|---|
| `Create` | `create` |
| `Update` | `update` |
| `Detail` | `detail` |
| `List` | `list` |
| `Filter` | `filter` |
| `Search` | `search` |
| `Sort` | `sort` |
| `Aggregate` | `aggregate` |
| `Report` | `report` |
| `Export` | `export` |
| `Audit` | `audit` |
| `Mcp` | `mcp` |
| `Relation` | `relation` |
| `Include` | `include` |
| `PublicReference` | `public_reference` |

## `Kumwe\BusinessPolicy\Application\FieldDisclosurePlan`

### `__construct`

`__construct(array $allowed (optional))`

```text
Create an explicit, canonical field allow-list for every usage.

@param   array<string, list<string>>  $allowed  Field handles keyed by `FieldAccessUsage::value`.

@throws  InvalidArgumentException  When a usage, handle, list shape, or overall field count is invalid.

@since   0.1.0
```

### `allows`

`allows(Kumwe\BusinessPolicy\Application\FieldAccessUsage $usage, string $field): bool`

```text
Report whether one field may be used in one way.

@param   FieldAccessUsage  $usage  Read, write, query, export, or audit use being attempted.
@param   string            $field  Stable field handle.

@return  bool  True only when the plan names the field for that exact usage.

@since   0.1.0
```

### `fields`

`fields(Kumwe\BusinessPolicy\Application\FieldAccessUsage $usage): array`

```text
List every field allowed for one use.

@param   FieldAccessUsage  $usage  Use whose explicit set is requested.

@return  list<string>  Canonically sorted field handles, possibly empty.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic disclosure document used by an access-plan digest.

@return  array<string, list<string>>  Every usage, including explicit empty sets.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyBoolean`

| Public property | Type | Mutability |
|---|---|---|
| `children` | `array` | readonly |
| `operator` | `Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator` | readonly |

### `__construct`

`__construct(Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator $operator, array $children)`

```text
Create a bounded, canonically ordered boolean composition.

@param   RecordPolicyBooleanOperator  $operator  Whether every or any child must hold.
@param   list<RecordPolicyPredicate>  $children  One to sixteen child predicates.

@throws  InvalidArgumentException  When the child list is empty, oversized, or contains another type.
@throws  JsonException  When a canonical child document cannot be encoded.

@since   0.1.0
```

### `depth`

`depth(): int`

```text
Measure the deepest path through this boolean subtree.

@return  int  Positive tree depth including this node.

@since   0.1.0
```

### `operationCount`

`operationCount(): int`

```text
Count this node and every child policy operation.

@return  int  Positive operation count for the complete subtree.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic boolean document used for policy digests.

@return  array<string, mixed>  Canonical boolean predicate document.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator`

| Case | Value |
|---|---|
| `All` | `all` |
| `Any` | `any` |

## `Kumwe\BusinessPolicy\Policy\RecordPolicyComparison`

| Public property | Type | Mutability |
|---|---|---|
| `field` | `string` | readonly |
| `operator` | `Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator` | readonly |
| `value` | `string|int|bool` | readonly |
| `valueType` | `Kumwe\BusinessPolicy\Policy\RecordPolicyValueType` | readonly |

### `__construct`

`__construct(string $field, Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator $operator, Kumwe\BusinessPolicy\Policy\RecordPolicyValueType $valueType, string|int|bool $value)`

```text
Create a typed comparison between one record field and one literal.

@param   string                          $field      Stable business-field handle to inspect.
@param   RecordPolicyComparisonOperator  $operator   Portable comparison to perform.
@param   RecordPolicyValueType           $valueType  Exact type of both field and literal.
@param   string|int|bool                 $value      Bounded literal; decimal values are canonical strings.

@throws  InvalidArgumentException  When the handle or literal contradicts the policy type contract.

@since   0.1.0
```

### `depth`

`depth(): int`

```text
Measure this leaf as a one-level tree.

@return  int  Always one.

@since   0.1.0
```

### `operationCount`

`operationCount(): int`

```text
Count this leaf as one policy operation.

@return  int  Always one.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic comparison document used for policy digests.

@return  array<string, mixed>  Canonical comparison predicate document.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator`

| Case | Value |
|---|---|
| `Equal` | `equal` |
| `NotEqual` | `not_equal` |
| `LessThan` | `less_than` |
| `LessThanOrEqual` | `less_than_or_equal` |
| `GreaterThan` | `greater_than` |
| `GreaterThanOrEqual` | `greater_than_or_equal` |

## `Kumwe\BusinessPolicy\Policy\RecordPolicyConstant`

| Public property | Type | Mutability |
|---|---|---|
| `value` | `bool` | readonly |

### `__construct`

`__construct(bool $value)`

```text
Create an explicit constant policy leaf.

@param  bool  $value  Truth value this leaf always produces.

@since  0.1.0
```

### `depth`

`depth(): int`

```text
Measure this leaf as a one-level tree.

@return  int  Always one.

@since   0.1.0
```

### `operationCount`

`operationCount(): int`

```text
Count this leaf as one policy operation.

@return  int  Always one.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic constant document used for policy digests.

@return  array<string, mixed>  Canonical constant predicate document.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyEvaluator`

### `allows`

`allows(Kumwe\BusinessPolicy\Policy\RecordPolicySet $policy, array $values): bool`

```text
Apply allow-first, deny-overrides semantics to one record.

@param   RecordPolicySet       $policy  Validated policy set to interpret.
@param   array<string, mixed>  $values  Record values keyed by field handle.

@return  bool  True only when at least one allow and no deny evaluates true.

@since   0.1.0
```

### `evaluate`

`evaluate(Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate $predicate, array $values): bool`

```text
Evaluate one validated predicate. Missing fields have SQL-null semantics.

@param   RecordPolicyPredicate  $predicate  Predicate node to interpret.
@param   array<string, mixed>   $values     Record values keyed by field handle.

@return  bool  Definite truth value; comparisons with null or a mismatched runtime type are false.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyNullCheck`

| Public property | Type | Mutability |
|---|---|---|
| `field` | `string` | readonly |
| `isNull` | `bool` | readonly |

### `__construct`

`__construct(string $field, bool $isNull (optional))`

```text
Create a null or non-null test for one declared field.

@param   string  $field   Stable business-field handle to inspect.
@param   bool    $isNull  True to match null, false to match a present non-null value.

@throws  InvalidArgumentException  When the field handle is malformed.

@since   0.1.0
```

### `depth`

`depth(): int`

```text
Measure this leaf as a one-level tree.

@return  int  Always one.

@since   0.1.0
```

### `operationCount`

`operationCount(): int`

```text
Count this leaf as one policy operation.

@return  int  Always one.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic null-check document used for policy digests.

@return  array<string, mixed>  Canonical null-check predicate document.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate`

### `depth`

`depth(): int`

```text
Measure the deepest path through this node.

@return  int  Positive tree depth.

@since   0.1.0
```

### `operationCount`

`operationCount(): int`

```text
Count this node and every descendant.

@return  int  Positive operation count.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the deterministic document used for policy digests.

@return  array<string, mixed>  Canonical predicate document.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicySchema`

### `__construct`

`__construct(array $fields)`

```text
Create and canonicalize a closed field/type vocabulary.

@param   array<string, RecordPolicyValueType>  $fields  Field handles and exact comparable types.

@throws  InvalidArgumentException  When the schema is oversized, unordered data is malformed, or a
         field handle/type is invalid.

@since   0.1.0
```

### `assertPredicate`

`assertPredicate(Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate $predicate): void`

```text
Validate every reference and comparison type in one predicate.

@param   RecordPolicyPredicate  $predicate  Bounded declarative predicate to validate.

@return  void

@throws  InvalidArgumentException  When a field is undeclared or a literal has another type.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the canonical field/type map.

@return  array<string, string>  Field handles keyed to scalar type identifiers.

@since   0.1.0
```

### `type`

`type(string $field): Kumwe\BusinessPolicy\Policy\RecordPolicyValueType`

```text
Return the type declared for a policy field.

@param   string  $field  Field handle to resolve.

@return  RecordPolicyValueType  Exact policy scalar type.

@throws  InvalidArgumentException  When the schema does not declare the field.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicySet`

| Public property | Type | Mutability |
|---|---|---|
| `allows` | `array` | readonly |
| `denies` | `array` | readonly |
| `schema` | `Kumwe\BusinessPolicy\Policy\RecordPolicySchema` | readonly |

### `__construct`

`__construct(Kumwe\BusinessPolicy\Policy\RecordPolicySchema $schema, array $allows (optional), array $denies (optional))`

```text
Create a bounded, schema-validated allow and deny policy set.

@param   RecordPolicySchema           $schema  Field vocabulary shared by compiler and evaluator.
@param   list<RecordPolicyPredicate>  $allows  Predicates granting access when one matches.
@param   list<RecordPolicyPredicate>  $denies  Predicates withholding access when one matches.

@throws  InvalidArgumentException  When policy counts, total operations, depth, fields, or types exceed bounds.
@throws  JsonException  When canonical ordering cannot encode a predicate.

@since   0.1.0
```

### `allows`

`allows(array $values): bool`

```text
Evaluate this set over one record value map.

@param   array<string, mixed>  $values  Stored values keyed by stable field handle.

@return  bool  True only when an allow matches and no deny matches.

@since   0.1.0
```

### `toArray`

`toArray(): array`

```text
Return the canonical policy document.

@return  array<string, mixed>  Schema plus ordered allow and deny predicate documents.

@since   0.1.0
```

## `Kumwe\BusinessPolicy\Policy\RecordPolicyValueType`

| Case | Value |
|---|---|
| `String` | `string` |
| `Integer` | `integer` |
| `Decimal` | `decimal` |
| `Boolean` | `boolean` |
| `Temporal` | `temporal` |

