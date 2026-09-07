---
schema: kumwe-migration-handoff/v2
artifact_kind: framework_php
migration_id: KUMWE-MIG-2026-022
change_set: KUMWE-CS-2026-022
state: draft_pr_open
source:
  app:
    repository: https://github.com/kumwe/app
    baseline_commit: 24ecf956423c18933e824b43cea1bfb9127a79a9
    examined_paths:
    - src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php
    - src/BusinessRecord/Application/BusinessRecordReadRepository.php
    - src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php
    - src/BusinessRecord/Application/BusinessRecordRevisionRepository.php
    - src/BusinessRecord/Application/BusinessRecordRevisionView.php
    - src/BusinessRecord/Application/BusinessRecordService.php
    - src/BusinessRecord/Application/BusinessRecordView.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php
    - src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php
    - src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php
    - src/BusinessSecurity/Application/BusinessRecordAccessController.php
    - src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php
    - src/BusinessSecurity/Application/BusinessRecordAccessPlan.php
    - src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php
    - src/BusinessSecurity/Policy/RecordPolicyBoolean.php
    - src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php
    - src/BusinessSecurity/Policy/RecordPolicyConstant.php
    - src/BusinessSecurity/Policy/RecordPolicyEvaluator.php
    - src/BusinessSecurity/Policy/RecordPolicyNullCheck.php
    - src/BusinessSecurity/Policy/RecordPolicySchema.php
    - src/BusinessSecurity/Policy/RecordPolicySet.php
    - src/BusinessSurface/Application/BusinessOperationStatusService.php
    - src/BusinessSurface/Application/BusinessSurfaceCatalog.php
    - src/BusinessSurface/Application/BusinessSurfaceOperation.php
    - src/Demo/Infrastructure/VdmBusinessDemoInstaller.php
    - tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php
    - tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php
    - tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php
    - tests/Support/NeutralBusinessFixture.php
    - tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php
    - tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php
    - tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php
    - tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php
    - tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php
    - tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php
    - tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php
    - tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php
    old_namespace_roots:
    - Kumwe\App\BusinessSecurity
    - Kumwe\Extension\Spi\BusinessSecurity
    capability_index_sha256: null
  semantic_inputs:
  - owner: kumwe/extension-sdk
    version_or_commit: e8ec23f155c5836c6bd083f154a8efb6e50aec66
    manifest_or_corpus: src/Spi/BusinessSecurity/{Policy,Application}; tests/Case/RecordPolicyTest.php
    sha256: 108932f78cace67fb494c34dc49087d57834a223ea8d138c414fd6c7feebc237
  examined_dependencies:
  - php:^8.5
  - ext-json:*
  - kumwe/access-context and kumwe/canonical-json are permitted ceilings, not selected dependencies
  active_related_pull_requests:
  - https://github.com/kumwe/business-policy/pull/1 (observed merged)
  - https://github.com/kumwe/business-policy/pull/2
target:
  repository: https://github.com/kumwe/business-policy
  artifact_identity: kumwe/business-policy
  canonical_namespace_or_abi: Kumwe\BusinessPolicy
  branch: codex/extraction-readiness-20260907
  pull_request: https://github.com/kumwe/business-policy/pull/3
ownership:
  responsibility: Bounded policy ASTs and deterministic evaluation, explicit field disclosure and portable immutable
    access plans
  non_responsibilities:
  - final authorization and step-up
  - active policy selection
  - actor/attribute/resource loading
  - database query compilation and post-load filtering
  - policy lifecycle/trust
  - audit and delivery
  allowed_dependency_ceiling:
  - kumwe/access-context
  - kumwe/canonical-json
  implementation_owner: https://github.com/kumwe/business-policy
  next_consumer: https://github.com/kumwe/extension-sdk then https://github.com/kumwe/app
  public_manifests:
  - path: resources/public-api/v1.json
    sha256: ea84598cfc3e7149da76119bf20d6ca641d29490585c18297b611dd032b9fabd
  - path: resources/capabilities/v1.json
    sha256: 9f391befbd525a5bf8122d7793678dc16de8d219953c1ede9927fa9c16d6e81b
  - path: resources/service-map/v1.json
    sha256: 1a32ed497f5517417ce5eb560f7b234709ba566e06b3f8991271a26d64c605fc
  intentionally_excluded:
  - App access controllers, administration services and DB query compilers
  - SDK other public SPIs
  - new attribute-reference/error types with no current implementation source
framework_php:
  composer_package: kumwe/business-policy
  canonical_namespace: Kumwe\BusinessPolicy
  public_api_manifest: resources/public-api/v1.json
  capability_manifest: resources/capabilities/v1.json
  service_map: resources/service-map/v1.json
  extracted_symbols:
  - old_fqcn: Kumwe\App\BusinessSecurity\Application\BusinessRecordAccessPlan
    new_fqcn: Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Application/BusinessRecordAccessPlan.php
    target_path: src/Application/BusinessRecordAccessPlan.php
    kind: class
    public_methods:
    - __construct
    - allowsAction
    - digest
    - durableDigest
    - related
    - toArray
    public_properties:
    - authorizationFingerprint
    - fields
    - operation
    - records
    - resourceIdentifier
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Application\FieldAccessUsage
    new_fqcn: Kumwe\BusinessPolicy\Application\FieldAccessUsage
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Application/FieldAccessUsage.php
    target_path: src/Application/FieldAccessUsage.php
    kind: enum
    public_methods: []
    public_properties: []
    public_constants:
    - Aggregate
    - Audit
    - Create
    - Detail
    - Export
    - Filter
    - Include
    - List
    - Mcp
    - PublicReference
    - Relation
    - Report
    - Search
    - Sort
    - Update
    exceptions: []
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Application\FieldDisclosurePlan
    new_fqcn: Kumwe\BusinessPolicy\Application\FieldDisclosurePlan
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Application/FieldDisclosurePlan.php
    target_path: src/Application/FieldDisclosurePlan.php
    kind: class
    public_methods:
    - __construct
    - allows
    - fields
    - toArray
    public_properties: []
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicyBoolean
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyBoolean
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicyBoolean.php
    target_path: src/Policy/RecordPolicyBoolean.php
    kind: class
    public_methods:
    - __construct
    - depth
    - operationCount
    - toArray
    public_properties:
    - children
    - operator
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicyBooleanOperator
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php
    target_path: src/Policy/RecordPolicyBooleanOperator.php
    kind: enum
    public_methods: []
    public_properties: []
    public_constants:
    - All
    - Any
    exceptions: []
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyComparison
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyComparison
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Policy/RecordPolicyComparison.php
    target_path: src/Policy/RecordPolicyComparison.php
    kind: class
    public_methods:
    - __construct
    - depth
    - operationCount
    - toArray
    public_properties:
    - field
    - operator
    - value
    - valueType
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyComparisonOperator
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Policy/RecordPolicyComparisonOperator.php
    target_path: src/Policy/RecordPolicyComparisonOperator.php
    kind: enum
    public_methods: []
    public_properties: []
    public_constants:
    - Equal
    - GreaterThan
    - GreaterThanOrEqual
    - LessThan
    - LessThanOrEqual
    - NotEqual
    exceptions: []
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicyConstant
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyConstant
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicyConstant.php
    target_path: src/Policy/RecordPolicyConstant.php
    kind: class
    public_methods:
    - __construct
    - depth
    - operationCount
    - toArray
    public_properties:
    - value
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicyEvaluator
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyEvaluator
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicyEvaluator.php
    target_path: src/Policy/RecordPolicyEvaluator.php
    kind: class
    public_methods:
    - allows
    - evaluate
    public_properties: []
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicyNullCheck
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyNullCheck
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicyNullCheck.php
    target_path: src/Policy/RecordPolicyNullCheck.php
    kind: class
    public_methods:
    - __construct
    - depth
    - operationCount
    - toArray
    public_properties:
    - field
    - isNull
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyPredicate
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Policy/RecordPolicyPredicate.php
    target_path: src/Policy/RecordPolicyPredicate.php
    kind: interface
    public_methods:
    - depth
    - operationCount
    - toArray
    public_properties: []
    public_constants: []
    exceptions: []
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicySchema
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicySchema
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicySchema.php
    target_path: src/Policy/RecordPolicySchema.php
    kind: class
    public_methods:
    - __construct
    - assertPredicate
    - toArray
    - type
    public_properties: []
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\App\BusinessSecurity\Policy\RecordPolicySet
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicySet
    source_repository: https://github.com/kumwe/app
    source_path: src/BusinessSecurity/Policy/RecordPolicySet.php
    target_path: src/Policy/RecordPolicySet.php
    kind: class
    public_methods:
    - __construct
    - allows
    - toArray
    public_properties:
    - allows
    - denies
    - schema
    public_constants: []
    exceptions:
    - InvalidArgumentException
    - TypeError
    - JsonException
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  - old_fqcn: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyValueType
    new_fqcn: Kumwe\BusinessPolicy\Policy\RecordPolicyValueType
    source_repository: https://github.com/kumwe/extension-sdk
    source_path: src/Spi/BusinessSecurity/Policy/RecordPolicyValueType.php
    target_path: src/Policy/RecordPolicyValueType.php
    kind: enum
    public_methods: []
    public_properties: []
    public_constants:
    - Boolean
    - Decimal
    - Integer
    - String
    - Temporal
    exceptions: []
    serialization_contract: docs/architecture.md
    compatibility: package-initial-profile; explicit extraction corrections in docs/security-compatibility.md
  consumers:
    app_code:
    - src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php
    - src/BusinessRecord/Application/BusinessRecordReadRepository.php
    - src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php
    - src/BusinessRecord/Application/BusinessRecordRevisionRepository.php
    - src/BusinessRecord/Application/BusinessRecordRevisionView.php
    - src/BusinessRecord/Application/BusinessRecordService.php
    - src/BusinessRecord/Application/BusinessRecordView.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php
    - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php
    - src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php
    - src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php
    - src/BusinessSecurity/Application/BusinessRecordAccessController.php
    - src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php
    - src/BusinessSecurity/Application/BusinessRecordAccessPlan.php
    - src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php
    - src/BusinessSecurity/Policy/RecordPolicyBoolean.php
    - src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php
    - src/BusinessSecurity/Policy/RecordPolicyConstant.php
    - src/BusinessSecurity/Policy/RecordPolicyEvaluator.php
    - src/BusinessSecurity/Policy/RecordPolicyNullCheck.php
    - src/BusinessSecurity/Policy/RecordPolicySchema.php
    - src/BusinessSecurity/Policy/RecordPolicySet.php
    - src/BusinessSurface/Application/BusinessOperationStatusService.php
    - src/BusinessSurface/Application/BusinessSurfaceCatalog.php
    - src/BusinessSurface/Application/BusinessSurfaceOperation.php
    - src/Demo/Infrastructure/VdmBusinessDemoInstaller.php
    configuration_and_di: []
    reflection_and_string_references: []
    fixtures_and_examples:
    - tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php
    - tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php
    - tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php
    - tests/Support/NeutralBusinessFixture.php
    - tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php
    - tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php
    - tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php
    - tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php
    - tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php
    - tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php
    - tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php
    - tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php
    external:
    - repository: kumwe/extension-sdk
      paths:
      - src/Spi/BusinessSecurity/Application/FieldAccessUsage.php
      - src/Spi/BusinessSecurity/Application/FieldDisclosurePlan.php
      - src/Spi/BusinessSecurity/Policy/RecordPolicyComparison.php
      - src/Spi/BusinessSecurity/Policy/RecordPolicyComparisonOperator.php
      - src/Spi/BusinessSecurity/Policy/RecordPolicyPredicate.php
      - src/Spi/BusinessSecurity/Policy/RecordPolicyValueType.php
      - tests/Case/PortableValueBoundaryTest.php
      - tests/Case/RecordPolicyTest.php
  dependency_injection:
    mode: direct
    provider: null
    factories: []
    aliases: []
    service_lifetimes:
    - 'immutable values: caller constructed'
    - 'stateless evaluator: safely shared if host chooses'
    configuration_keys: []
    provider_absence_reason: No injected runtime service is exported. The evaluator has no collaborators; compilers
      and active registries remain App-owned.
native_cpp: null
php_extension: null
tests:
  moved_or_added:
  - tests/RecordPolicyTest.php
  - tests/BusinessRecordAccessPlanTest.php
  - tests/PolicyBoundaryTest.php
  - tests/PolicyCorpusTest.php
  remain_in_app_or_consumer:
  - tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php
  - tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php
  - tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php
  - tests/Support/NeutralBusinessFixture.php
  - tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php
  - tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php
  - tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php
  - tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php
  - tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php
  - tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php
  split_tests:
  - App access-plan unit test retains host authority responsibility while portable plan assertions are package-owned
  prohibited_duplicates:
  - App/SDK class behavior tests must be removed during their separate adoption, never in this package phase
  corpora:
  - path: resources/policy-corpus/v1.json
    sha256: 4534b98bfe121b2d9cf27cecc1990910c68db91708a60e3e135a058eca9d4419
  - path: resources/policy-corpus/canonical-v1.json
    sha256: 412b7ad71b4a434cc842a677c93c6689cb0d8f78fd5824c02a2a31c281fb9f8d
documentation:
  charter: CHARTER.md
  readme: README.md
  public_api: docs/public-api.md
  architecture: docs/architecture.md
  integration_or_consumer: docs/integration.md
  examples:
  - examples/policy.php
  changelog_record: CHANGELOG.md / 0.1.1
release_expectations:
  version_policy: SemVer; current candidate record 0.1.0; actual release identity must be observed externally; consumers
    exact-pin pre-1.0
  expected_artifact_types:
  - Composer source ZIP
  - GitHub immutable release/tag
  required_checks:
  - composer check
  - default-branch package gate
  - release integrity and dependency attestation checks
  required_registry_or_installer: Composer
  required_external_attestation: true
next_task:
  phase_name: Release verification, then Extension SDK dependency/duplicate-removal successor; App Phase 2 follows
    verified SDK release
  permitted_only_when:
  - human merges package PR
  - immutable package publication observed
  - separate RELEASE-ATTESTATION.yaml verifies exact release and archive
  - SDK downward dependency update released and verified before App composition
  consumer_repository: https://github.com/kumwe/app
  dependency_or_native_change: Exact-pin verified kumwe/business-policy and compatible verified SDK release through
    Composer; no native dependency
  namespace_or_api_replacements:
  - old: Kumwe\App\BusinessSecurity\Application\BusinessRecordAccessPlan
    new: Kumwe\BusinessPolicy\Application\BusinessRecordAccessPlan
  - old: Kumwe\Extension\Spi\BusinessSecurity\Application\FieldAccessUsage
    new: Kumwe\BusinessPolicy\Application\FieldAccessUsage
  - old: Kumwe\Extension\Spi\BusinessSecurity\Application\FieldDisclosurePlan
    new: Kumwe\BusinessPolicy\Application\FieldDisclosurePlan
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicyBoolean
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyBoolean
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicyBooleanOperator
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyBooleanOperator
  - old: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyComparison
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyComparison
  - old: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyComparisonOperator
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyComparisonOperator
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicyConstant
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyConstant
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicyEvaluator
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyEvaluator
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicyNullCheck
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyNullCheck
  - old: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyPredicate
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyPredicate
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicySchema
    new: Kumwe\BusinessPolicy\Policy\RecordPolicySchema
  - old: Kumwe\App\BusinessSecurity\Policy\RecordPolicySet
    new: Kumwe\BusinessPolicy\Policy\RecordPolicySet
  - old: Kumwe\Extension\Spi\BusinessSecurity\Policy\RecordPolicyValueType
    new: Kumwe\BusinessPolicy\Policy\RecordPolicyValueType
  files_to_update:
  - src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php
  - src/BusinessRecord/Application/BusinessRecordReadRepository.php
  - src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php
  - src/BusinessRecord/Application/BusinessRecordRevisionRepository.php
  - src/BusinessRecord/Application/BusinessRecordRevisionView.php
  - src/BusinessRecord/Application/BusinessRecordService.php
  - src/BusinessRecord/Application/BusinessRecordView.php
  - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php
  - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php
  - src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php
  - src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php
  - src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php
  - src/BusinessSecurity/Application/BusinessRecordAccessController.php
  - src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php
  - src/BusinessSecurity/Application/BusinessRecordAccessPlan.php
  - src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php
  - src/BusinessSecurity/Policy/RecordPolicyBoolean.php
  - src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php
  - src/BusinessSecurity/Policy/RecordPolicyConstant.php
  - src/BusinessSecurity/Policy/RecordPolicyEvaluator.php
  - src/BusinessSecurity/Policy/RecordPolicyNullCheck.php
  - src/BusinessSecurity/Policy/RecordPolicySchema.php
  - src/BusinessSecurity/Policy/RecordPolicySet.php
  - src/BusinessSurface/Application/BusinessOperationStatusService.php
  - src/BusinessSurface/Application/BusinessSurfaceCatalog.php
  - src/BusinessSurface/Application/BusinessSurfaceOperation.php
  - src/Demo/Infrastructure/VdmBusinessDemoInstaller.php
  - tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php
  - tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php
  - tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php
  - tests/Support/NeutralBusinessFixture.php
  - tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php
  - tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php
  - tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php
  - tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php
  - tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php
  - tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php
  - tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php
  - tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php
  - composer.json
  - composer.lock
  - capability index and migration ledger at then-current canonical paths
  files_to_remove:
  - src/BusinessSecurity/Application/BusinessRecordAccessPlan.php
  - src/BusinessSecurity/Policy/RecordPolicyBoolean.php
  - src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php
  - src/BusinessSecurity/Policy/RecordPolicyConstant.php
  - src/BusinessSecurity/Policy/RecordPolicyEvaluator.php
  - src/BusinessSecurity/Policy/RecordPolicyNullCheck.php
  - src/BusinessSecurity/Policy/RecordPolicySchema.php
  - src/BusinessSecurity/Policy/RecordPolicySet.php
  tests_to_remove:
  - tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php
  tests_to_retain_or_add:
  - tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php
  - tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php
  - tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php
  - tests/Support/NeutralBusinessFixture.php
  - tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php
  - tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php
  - tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php
  - tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php
  - tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php
  - tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php
  - 'tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php: retain the host-contract assertion
    only; remove migrated portable plan assertions'
  di_or_provisioning_changes:
  - Update canonical type hints in host factories/controllers; no package provider registration
  capability_index_changes:
  - Record canonical package owner and link exact release evidence; do not claim roadmap completion
  changelog_and_evidence_changes:
  - Record NRM-2026-022 adoption and integration-train evidence
  verification_commands:
  - composer validate --strict
  - composer audit --abandoned=fail
  - run full affected App unit/integration train
  - rg old policy/disclosure namespaces in source/config/tests and reject duplicates
concurrency:
  likely_conflict_files:
  - App composer.json and composer.lock
  - App BusinessSecurity/BusinessRecord imports
  - SDK composer.json and src/Spi/BusinessSecurity
  - App capability index and migration evidence ledger
  related_migrations:
  - access-context
  - business-definition
  - record-query
  - extension-sdk
  ownership_conflicts:
  - Physical App/SDK duplicates intentionally await separate verified adoption
  integration_train: Access and Assurance / business-record security
  resolution_rule: semantic-preservation
governance:
  roadmap_source_sha256: a202155ef1a65f5ab293d4f8397ebf4ac430db7f1e877c776bbe7851e6fe18d8
  roadmap_refs: []
  non_roadmap_refs:
  - NRM-2026-022
  completion_claim: false
decisions:
- 14-type actual closure replaces approximate 16-type candidate scope
- 'No external Kumwe dependency selected: preserving the existing policy JSON profile avoids introducing an unverified
  canonicalization dependency'
- Stateless evaluator is directly constructible; no empty ConfigProvider
- Early bounded/closed-tree validation, exact decimal digit ordering, UTF-8 and explicit disclosure shape refusals
  are initial-package corrections
- Opaque resource string and normalized decimal/Stringable values replace host value dependencies
- No App/SDK edits, merge, release or adoption performed
blockers:
- Adoption waits for externally verified immutable package and SDK releases
---

# Migration/implementation summary

14 types; bounded closed AST, exact deterministic scalar evaluation, deny precedence, all field-disclosure usages and access-plan values. Runtime malformed/oversized strings now fail closed even for inequality; operation names are bounded at 127 bytes. Existing 106-case semantic corpus remains versioned.

## Public API and responsibility

The symbol map above and [public API](docs/public-api.md) define every exported contract. [Architecture](docs/architecture.md) and [integration](docs/integration.md) retain the host boundaries.

## Capability reuse/semantic input review

No Kumwe runtime dependency. Canonical policy bytes are owned by this package; no new native policy execution or SDK/App edits are included. [Current release/dependency observations](docs/readiness-review.md) supersede obsolete initial-extraction publication blockers. No independent attestation is fabricated.

## Consumer inventory and drift check

The source/consumer mappings above remain the adoption inventory. Compare every mapped file and public signature against the recorded full App baseline and current App before consumer changes. Any newer portable behavior goes upstream first. Preserve App authority, adapters and workflows.

## Test ownership

Package tests own portable behavior, boundary/conformance, API and construction. App retains actual authorization, transaction atomicity, persistence, concurrency, recovery and delivery tests. Remove only duplicate portable implementation tests during the separate verified adoption.

## Next-task execution notes

Review [PR #3](https://github.com/kumwe/business-policy/pull/3), require its complete package gate, then let the maintainer merge. Independently verify the published successor and exact dependency graph before App adoption. Existing published releases stay intact. This task does not implement the App runtime cutover.

## Validation recipe

Run `composer check` and the repository release automation regressions. Runtime suites, strict static analysis, coding standards, manifest/API checks and the no-dev authoritative archive consumer remain required. Final tested source and archive identities belong in external CI/attestation evidence.
