#!/usr/bin/env bash
# Prove the durable release-record gate fails closed when consumer evidence is damaged.
set -euo pipefail

root="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")/.." && pwd)"
workspace="$(mktemp -d)"
trap 'rm -rf -- "$workspace"' EXIT
mkdir -p "$workspace/tools"
cp "$root/composer.json" "$workspace/"
cp -R "$root/docs" "$root/resources" "$workspace/"
cp -R "$root/tools/schemas" "$workspace/tools/"
cp "$root/tools/verify-governed-manifests.php" "$workspace/tools/"

verify() {
  php "$workspace/tools/verify-governed-manifests.php"
}

expect_failure() {
  if verify > "$workspace/result.log" 2>&1; then
    echo "Manifest verification unexpectedly accepted $1" >&2
    exit 1
  fi
  if ! grep -Fq -- "$2" "$workspace/result.log"; then
    cat "$workspace/result.log" >&2
    exit 1
  fi
}

verify
record="$workspace/docs/release-record.md"
cp "$record" "$workspace/original.md"

sed '/path: "resources\/public-api\/v1.json"/{n;s/sha256:/invalid_digest:/;}' "$workspace/original.md" > "$record"
expect_failure 'a missing manifest digest' 'Release-record manifest digest is absent or stale'

sed 's/kumwe-package-release-record\/v1/kumwe-package-release-record\/v99/' "$workspace/original.md" > "$record"
expect_failure 'an unsupported record schema' 'Release record must retain v1 front matter'

sed 's/^## Consumer contract$/## Obsolete instructions/' "$workspace/original.md" > "$record"
expect_failure 'a missing consumer contract' 'eight ordered contract sections'

cp "$workspace/original.md" "$record"
rm "$workspace/docs/integration.md"
expect_failure 'missing shipped integration documentation' 'Capability documentation is not shipped'

echo 'Release-record identity, digest, contract and shipped-document regressions passed.'
