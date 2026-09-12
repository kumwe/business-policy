---
schema: "kumwe-package-release-record/v1"
artifact_kind: "framework_php"
migration_id: "KUMWE-MIG-2026-022"
change_set: "KUMWE-CS-2026-022"
source:
  app:
    repository: "https://github.com/kumwe/app"
    baseline_commit: "24ecf956423c18933e824b43cea1bfb9127a79a9"
    examined_paths:
      - "src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php"
      - "src/BusinessRecord/Application/BusinessRecordReadRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/BusinessRecordView.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessController.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessPlan.php"
      - "src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php"
      - "src/BusinessSecurity/Policy/RecordPolicyBoolean.php"
      - "src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php"
      - "src/BusinessSecurity/Policy/RecordPolicyConstant.php"
      - "src/BusinessSecurity/Policy/RecordPolicyEvaluator.php"
      - "src/BusinessSecurity/Policy/RecordPolicyNullCheck.php"
      - "src/BusinessSecurity/Policy/RecordPolicySchema.php"
      - "src/BusinessSecurity/Policy/RecordPolicySet.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusService.php"
      - "src/BusinessSurface/Application/BusinessSurfaceCatalog.php"
      - "src/BusinessSurface/Application/BusinessSurfaceOperation.php"
      - "src/Demo/Infrastructure/VdmBusinessDemoInstaller.php"
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php"
      - "tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php"
      - "tests/Support/NeutralBusinessFixture.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php"
      - "tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
      - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
    old_namespace_roots:
      - "Kumwe\\App\\BusinessSecurity\\"
      - "Kumwe\\Extension\\Spi\\BusinessSecurity\\"
    capability_index_sha256: null
  semantic_inputs:
    -
      owner: "kumwe/extension-sdk"
      version_or_commit: "e8ec23f155c5836c6bd083f154a8efb6e50aec66"
      manifest_or_corpus: "src/Spi/BusinessSecurity/{Policy,Application}; tests/Case/RecordPolicyTest.php"
      sha256: "108932f78cace67fb494c34dc49087d57834a223ea8d138c414fd6c7feebc237"
  examined_dependencies:
    - "php:^8.5"
    - "ext-json:*"
    - "kumwe/access-context and kumwe/canonical-json are permitted ceilings, not selected dependencies"
target:
  repository: "https://github.com/kumwe/business-policy"
  artifact_identity: "kumwe/business-policy"
  canonical_namespace_or_abi: "Kumwe\\BusinessPolicy"
ownership:
  responsibility: "Bounded policy ASTs and deterministic evaluation, explicit field disclosure and portable immutable access plans"
  non_responsibilities:
    - "final authorization and step-up"
    - "active policy selection"
    - "actor/attribute/resource loading"
    - "database query compilation and post-load filtering"
    - "policy lifecycle/trust"
    - "audit and delivery"
  allowed_dependency_ceiling:
    - "kumwe/access-context"
    - "kumwe/canonical-json"
  implementation_owner: "https://github.com/kumwe/business-policy"
  next_consumer: "https://github.com/kumwe/extension-sdk then https://github.com/kumwe/app"
  public_manifests:
    -
      path: "resources/public-api/v1.json"
      sha256: "ea84598cfc3e7149da76119bf20d6ca641d29490585c18297b611dd032b9fabd"
    -
      path: "resources/capabilities/v1.json"
      sha256: "7b64637adad6a6c9067d39d1635f66d4748cc1423f0e1d318c6ec3172e9fa362"
    -
      path: "resources/service-map/v1.json"
      sha256: "8361cc187e2dd3093e748290d2ccf7b52d53ae6273b2100980eae82e3a5b92e7"
  intentionally_excluded:
    - "App access controllers, administration services and DB query compilers"
    - "SDK other public SPIs"
    - "new attribute-reference/error types with no current implementation source"
framework_php:
  composer_package: "kumwe/business-policy"
  canonical_namespace: "Kumwe\\BusinessPolicy"
  public_api_manifest: "resources/public-api/v1.json"
  capability_manifest: "resources/capabilities/v1.json"
  service_map: "resources/service-map/v1.json"
  extracted_symbols:
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Application\\BusinessRecordAccessPlan"
      new_fqcn: "Kumwe\\BusinessPolicy\\Application\\BusinessRecordAccessPlan"
      source_path: "src/BusinessSecurity/Application/BusinessRecordAccessPlan.php"
      target_path: "src/Application/BusinessRecordAccessPlan.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "allowsAction"
        - "digest"
        - "durableDigest"
        - "related"
        - "toArray"
      public_properties:
        - "authorizationFingerprint"
        - "fields"
        - "operation"
        - "records"
        - "resourceIdentifier"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Application\\FieldAccessUsage"
      new_fqcn: "Kumwe\\BusinessPolicy\\Application\\FieldAccessUsage"
      source_path: "src/Spi/BusinessSecurity/Application/FieldAccessUsage.php"
      target_path: "src/Application/FieldAccessUsage.php"
      kind: "enum"
      public_methods: []
      public_properties: []
      public_constants:
        - "Aggregate"
        - "Audit"
        - "Create"
        - "Detail"
        - "Export"
        - "Filter"
        - "Include"
        - "List"
        - "Mcp"
        - "PublicReference"
        - "Relation"
        - "Report"
        - "Search"
        - "Sort"
        - "Update"
      exceptions: []
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Application\\FieldDisclosurePlan"
      new_fqcn: "Kumwe\\BusinessPolicy\\Application\\FieldDisclosurePlan"
      source_path: "src/Spi/BusinessSecurity/Application/FieldDisclosurePlan.php"
      target_path: "src/Application/FieldDisclosurePlan.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "allows"
        - "fields"
        - "toArray"
      public_properties: []
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyBoolean"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyBoolean"
      source_path: "src/BusinessSecurity/Policy/RecordPolicyBoolean.php"
      target_path: "src/Policy/RecordPolicyBoolean.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "depth"
        - "operationCount"
        - "toArray"
      public_properties:
        - "children"
        - "operator"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyBooleanOperator"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyBooleanOperator"
      source_path: "src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php"
      target_path: "src/Policy/RecordPolicyBooleanOperator.php"
      kind: "enum"
      public_methods: []
      public_properties: []
      public_constants:
        - "All"
        - "Any"
      exceptions: []
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyComparison"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyComparison"
      source_path: "src/Spi/BusinessSecurity/Policy/RecordPolicyComparison.php"
      target_path: "src/Policy/RecordPolicyComparison.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "depth"
        - "operationCount"
        - "toArray"
      public_properties:
        - "field"
        - "operator"
        - "value"
        - "valueType"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyComparisonOperator"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyComparisonOperator"
      source_path: "src/Spi/BusinessSecurity/Policy/RecordPolicyComparisonOperator.php"
      target_path: "src/Policy/RecordPolicyComparisonOperator.php"
      kind: "enum"
      public_methods: []
      public_properties: []
      public_constants:
        - "Equal"
        - "GreaterThan"
        - "GreaterThanOrEqual"
        - "LessThan"
        - "LessThanOrEqual"
        - "NotEqual"
      exceptions: []
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyConstant"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyConstant"
      source_path: "src/BusinessSecurity/Policy/RecordPolicyConstant.php"
      target_path: "src/Policy/RecordPolicyConstant.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "depth"
        - "operationCount"
        - "toArray"
      public_properties:
        - "value"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyEvaluator"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyEvaluator"
      source_path: "src/BusinessSecurity/Policy/RecordPolicyEvaluator.php"
      target_path: "src/Policy/RecordPolicyEvaluator.php"
      kind: "class"
      public_methods:
        - "allows"
        - "evaluate"
      public_properties: []
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyNullCheck"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyNullCheck"
      source_path: "src/BusinessSecurity/Policy/RecordPolicyNullCheck.php"
      target_path: "src/Policy/RecordPolicyNullCheck.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "depth"
        - "operationCount"
        - "toArray"
      public_properties:
        - "field"
        - "isNull"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyPredicate"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyPredicate"
      source_path: "src/Spi/BusinessSecurity/Policy/RecordPolicyPredicate.php"
      target_path: "src/Policy/RecordPolicyPredicate.php"
      kind: "interface"
      public_methods:
        - "depth"
        - "operationCount"
        - "toArray"
      public_properties: []
      public_constants: []
      exceptions: []
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicySchema"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicySchema"
      source_path: "src/BusinessSecurity/Policy/RecordPolicySchema.php"
      target_path: "src/Policy/RecordPolicySchema.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "assertPredicate"
        - "toArray"
        - "type"
      public_properties: []
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicySet"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicySet"
      source_path: "src/BusinessSecurity/Policy/RecordPolicySet.php"
      target_path: "src/Policy/RecordPolicySet.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "allows"
        - "toArray"
      public_properties:
        - "allows"
        - "denies"
        - "schema"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
        - "TypeError"
        - "JsonException"
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyValueType"
      new_fqcn: "Kumwe\\BusinessPolicy\\Policy\\RecordPolicyValueType"
      source_path: "src/Spi/BusinessSecurity/Policy/RecordPolicyValueType.php"
      target_path: "src/Policy/RecordPolicyValueType.php"
      kind: "enum"
      public_methods: []
      public_properties: []
      public_constants:
        - "Boolean"
        - "Decimal"
        - "Integer"
        - "String"
        - "Temporal"
      exceptions: []
      serialization_contract: "docs/architecture.md"
      compatibility: "Versioned policy profile; security boundaries in docs/security-compatibility.md"
  consumers:
    app_code:
      - "src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php"
      - "src/BusinessRecord/Application/BusinessRecordReadRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/BusinessRecordView.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessController.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessPlan.php"
      - "src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php"
      - "src/BusinessSecurity/Policy/RecordPolicyBoolean.php"
      - "src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php"
      - "src/BusinessSecurity/Policy/RecordPolicyConstant.php"
      - "src/BusinessSecurity/Policy/RecordPolicyEvaluator.php"
      - "src/BusinessSecurity/Policy/RecordPolicyNullCheck.php"
      - "src/BusinessSecurity/Policy/RecordPolicySchema.php"
      - "src/BusinessSecurity/Policy/RecordPolicySet.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusService.php"
      - "src/BusinessSurface/Application/BusinessSurfaceCatalog.php"
      - "src/BusinessSurface/Application/BusinessSurfaceOperation.php"
      - "src/Demo/Infrastructure/VdmBusinessDemoInstaller.php"
    configuration_and_di: []
    reflection_and_string_references: []
    fixtures_and_examples:
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php"
      - "tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php"
      - "tests/Support/NeutralBusinessFixture.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php"
      - "tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
      - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
    external:
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Application/FieldAccessUsage.php"
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Application/FieldDisclosurePlan.php"
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Policy/RecordPolicyComparison.php"
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Policy/RecordPolicyComparisonOperator.php"
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Policy/RecordPolicyPredicate.php"
      - "kumwe/extension-sdk:src/Spi/BusinessSecurity/Policy/RecordPolicyValueType.php"
      - "kumwe/extension-sdk:tests/Case/PortableValueBoundaryTest.php"
      - "kumwe/extension-sdk:tests/Case/RecordPolicyTest.php"
  dependency_injection:
    mode: "direct"
    provider: null
    factories: []
    aliases: []
    service_lifetimes:
      - "immutable values: caller constructed"
      - "stateless evaluator: safely shared if host chooses"
    configuration_keys: []
    provider_absence_reason: "No injected runtime service is exported. The evaluator has no collaborators; compilers and active registries remain host-owned."
native_cpp: null
php_extension: null
tests:
  moved_or_added:
    - "tests/RecordPolicyTest.php"
    - "tests/BusinessRecordAccessPlanTest.php"
    - "tests/PolicyBoundaryTest.php"
    - "tests/PolicyCorpusTest.php"
  remain_in_app_or_consumer:
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php"
    - "tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php"
    - "tests/Support/NeutralBusinessFixture.php"
    - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
    - "tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
    - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
    - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
  split_tests:
    - "App access-plan unit test retains host authority responsibility while portable plan assertions are package-owned"
  prohibited_duplicates:
    - "Consumers remove duplicate portable class behavior tests when adopting canonical package types; retain host integration coverage"
  corpora:
    - "resources/policy-corpus/v1.json (SHA-256 4534b98bfe121b2d9cf27cecc1990910c68db91708a60e3e135a058eca9d4419)"
    - "resources/policy-corpus/canonical-v1.json (SHA-256 412b7ad71b4a434cc842a677c93c6689cb0d8f78fd5824c02a2a31c281fb9f8d)"
documentation:
  charter: "CHARTER.md"
  readme: "README.md"
  public_api: "docs/public-api.md"
  architecture: "docs/architecture.md"
  integration_or_consumer: "docs/integration.md"
  examples:
    - "examples/policy.php"
  changelog_record: "CHANGELOG.md / 0.1.1"
release_expectations:
  version_policy: "SemVer; observe exact release identity externally; consumers exact-pin pre-1.0"
  expected_artifact_types:
    - "Composer source ZIP"
    - "GitHub immutable release/tag"
  required_checks:
    - "composer check"
    - "default-branch package gate"
    - "release integrity and dependency attestation checks"
  required_registry_or_installer: "Composer"
  required_external_attestation: true
consumer_contract:
  permitted_only_when:
    - "package source passes its complete quality gate"
    - "immutable package publication observed"
    - "separate RELEASE-ATTESTATION.yaml verifies exact release and archive"
    - "the selected SDK release uses the same canonical package types"
  consumer_repository: "https://github.com/kumwe/app"
  dependency_or_native_change: "Exact-pin verified kumwe/business-policy and a compatible verified SDK release through Composer; no native dependency"
  namespace_or_api_replacements:
    - "Kumwe\\App\\BusinessSecurity\\Application\\BusinessRecordAccessPlan => Kumwe\\BusinessPolicy\\Application\\BusinessRecordAccessPlan"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Application\\FieldAccessUsage => Kumwe\\BusinessPolicy\\Application\\FieldAccessUsage"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Application\\FieldDisclosurePlan => Kumwe\\BusinessPolicy\\Application\\FieldDisclosurePlan"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyBoolean => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyBoolean"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyBooleanOperator => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyBooleanOperator"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyComparison => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyComparison"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyComparisonOperator => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyComparisonOperator"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyConstant => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyConstant"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyEvaluator => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyEvaluator"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicyNullCheck => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyNullCheck"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyPredicate => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyPredicate"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicySchema => Kumwe\\BusinessPolicy\\Policy\\RecordPolicySchema"
    - "Kumwe\\App\\BusinessSecurity\\Policy\\RecordPolicySet => Kumwe\\BusinessPolicy\\Policy\\RecordPolicySet"
    - "Kumwe\\Extension\\Spi\\BusinessSecurity\\Policy\\RecordPolicyValueType => Kumwe\\BusinessPolicy\\Policy\\RecordPolicyValueType"
  files_to_update:
    - "src/Administrator/Http/Handler/AdministratorBusinessSecurityHandler.php"
    - "src/BusinessRecord/Application/BusinessRecordReadRepository.php"
    - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
    - "src/BusinessRecord/Application/BusinessRecordRevisionRepository.php"
    - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
    - "src/BusinessRecord/Application/BusinessRecordService.php"
    - "src/BusinessRecord/Application/BusinessRecordView.php"
    - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php"
    - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php"
    - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
    - "src/BusinessSecurity/Application/Administration/BusinessSecurityAdministrationService.php"
    - "src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php"
    - "src/BusinessSecurity/Application/BusinessRecordAccessController.php"
    - "src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php"
    - "src/BusinessSecurity/Application/BusinessRecordAccessPlan.php"
    - "src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php"
    - "src/BusinessSecurity/Policy/RecordPolicyBoolean.php"
    - "src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php"
    - "src/BusinessSecurity/Policy/RecordPolicyConstant.php"
    - "src/BusinessSecurity/Policy/RecordPolicyEvaluator.php"
    - "src/BusinessSecurity/Policy/RecordPolicyNullCheck.php"
    - "src/BusinessSecurity/Policy/RecordPolicySchema.php"
    - "src/BusinessSecurity/Policy/RecordPolicySet.php"
    - "src/BusinessSurface/Application/BusinessOperationStatusService.php"
    - "src/BusinessSurface/Application/BusinessSurfaceCatalog.php"
    - "src/BusinessSurface/Application/BusinessSurfaceOperation.php"
    - "src/Demo/Infrastructure/VdmBusinessDemoInstaller.php"
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php"
    - "tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php"
    - "tests/Support/NeutralBusinessFixture.php"
    - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
    - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php"
    - "tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php"
    - "tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
    - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
    - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
    - "composer.json"
    - "composer.lock"
    - "capability index and migration ledger at then-current canonical paths"
  files_to_remove:
    - "src/BusinessSecurity/Application/BusinessRecordAccessPlan.php"
    - "src/BusinessSecurity/Policy/RecordPolicyBoolean.php"
    - "src/BusinessSecurity/Policy/RecordPolicyBooleanOperator.php"
    - "src/BusinessSecurity/Policy/RecordPolicyConstant.php"
    - "src/BusinessSecurity/Policy/RecordPolicyEvaluator.php"
    - "src/BusinessSecurity/Policy/RecordPolicyNullCheck.php"
    - "src/BusinessSecurity/Policy/RecordPolicySchema.php"
    - "src/BusinessSecurity/Policy/RecordPolicySet.php"
  tests_to_remove:
    - "tests/Unit/BusinessSecurity/Policy/RecordPolicyTest.php"
  tests_to_retain_or_add:
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
    - "tests/Integration/BusinessRecord/BusinessRecordPolicyEnforcementIntegrationTest.php"
    - "tests/Integration/Extension/AssetInspectionCustomViewIntegrationTest.php"
    - "tests/Support/NeutralBusinessFixture.php"
    - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
    - "tests/Unit/BusinessSecurity/Application/BusinessSecurityAdministrationServiceTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessMutationPlanServiceTest.php"
    - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
    - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
    - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
    - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php: retain the host-contract assertion only; remove migrated portable plan assertions"
  di_or_provisioning_changes:
    - "Update canonical type hints in host factories/controllers; no package provider registration"
  capability_index_changes:
    - "Record canonical package owner and link exact release evidence; do not claim roadmap completion"
  changelog_and_evidence_changes:
    - "Record selected package and SDK versions, verified release identities and consumer integration evidence"
  verification_commands:
    - "composer validate --strict"
    - "composer audit --abandoned=fail"
    - "run full affected App unit/integration train"
    - "rg old policy/disclosure namespaces in source/config/tests and reject duplicates"
governance:
  completion_claim: false
decisions:
  - "The package exports 14 policy, disclosure and access-plan types"
  - "No external Kumwe runtime dependency: the versioned policy JSON profile belongs to this package"
  - "Stateless evaluator is directly constructible; no empty ConfigProvider"
  - "Bounded closed-tree validation, exact decimal digit ordering, UTF-8 and explicit disclosure shape refusals are compatibility contracts"
  - "Opaque resource string and normalized decimal/Stringable values replace host value dependencies"
blockers: []
---

# Package release record

This record binds the package's public manifests, compatibility baseline, symbol
mapping, dependency-injection contract and consumer test ownership. It uses
`kumwe-package-release-record/v1`. Source paths and commit IDs identify the
recorded baseline for compatibility review; they do not report the current state
of another repository. Published release identities and verification results are
observed externally.

## Package contract

The package provides 14 policy, disclosure and access-plan types. Core and other
hosts own final authorization, active policy selection, data loading, database
compilation, transactions, audit and delivery. See [host integration](integration.md).

## Public API and responsibility

The symbol map above and [public API](public-api.md) define exported contracts.
The [architecture](architecture.md) defines serialization and deterministic
evaluation. Manifest paths in the front matter are repository-relative.

## Dependencies and semantic inputs

Runtime requirements are PHP 8.5 and JSON, with no third-party runtime dependencies.
The package owns its versioned policy JSON profile and language-neutral corpus.
Other implementations run that corpus before claiming semantic compatibility.

## Consumer contract

The source and consumer mappings above describe the recorded compatibility
baseline. Compare mapped files and signatures with the consumer's current source
before updating imports, removing duplicate implementations or changing DI type
hints. Preserve newer portable behavior in this package and host-specific behavior
in the consuming application.

## Test ownership

Package tests own portable behavior, boundary/conformance, API and direct
construction. Consumers retain authorization, query isolation, transaction
atomicity, persistence, concurrency, recovery and delivery tests. See the
[test ownership contract](integration.md#test-ownership).

## Consumer verification

Pin an exact pre-1.0 release. Verify the published source, archive, manifest
digests and a no-dev authoritative consumer installation, then run the affected
consumer integration suites. When using Extension SDK, select a compatible
verified SDK release that consumes the same canonical types.

## Compatibility and drift

Compare the source and tests against the recorded baseline before consumer
changes. A package CI result does not establish consumer integration or roadmap
completion. Immutable published tags, release evidence and historical changelog
entries remain fixed.

## Validation

Run `composer check`. The gate covers runtime behavior, strict static analysis,
coding standards, manifest/API identity, archive contents, clean-consumer
installation and release automation. Final tested source and artifact identities
belong in external CI and release-attestation evidence.
