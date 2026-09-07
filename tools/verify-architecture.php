<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$metadata = json_decode(file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
if ($metadata['require'] !== ['php' => '^8.5', 'ext-json' => '*']) {
    throw new RuntimeException('Review every new runtime dependency against the package ceiling.');
}
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/src', FilesystemIterator::SKIP_DOTS));
$count = 0;
foreach ($files as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'php') {
        continue;
    }
    $source = file_get_contents($file->getPathname());
    if (!str_contains($source, 'namespace Kumwe\\BusinessPolicy\\')) {
        throw new RuntimeException('Source escaped the canonical namespace: ' . $file->getPathname());
    }
    if (preg_match('/Kumwe\\\\(?:App|Extension)\\\\|Doctrine\\\\|PDO|class_alias\s*\(|getenv\s*\(|file_get_contents\s*\(|curl_|exec\s*\(|include\s|require\s/', $source)) {
        throw new RuntimeException('Host or IO dependency leaked into ' . $file->getPathname());
    }
    ++$count;
}
$services = json_decode(file_get_contents($root . '/resources/service-map/v1.json'), true, 512, JSON_THROW_ON_ERROR);
if (
    $services['schema'] !== 'kumwe-package-service-map/v1'
    || $services['config_provider'] !== null || $services['factories'] !== []
) {
    throw new RuntimeException('The stateless evaluator and immutable values do not require a container provider.');
}
if ($count !== 14 || is_file($root . '/src/ConfigProvider.php')) {
    throw new RuntimeException('Review public ownership drift and provider necessity.');
}
echo "Architecture passed: 14 types, closed grammar, no host, SDK, database or IO dependency.\n";
