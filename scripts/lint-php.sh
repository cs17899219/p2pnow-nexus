#!/bin/sh
set -eu

if ! command -v php >/dev/null 2>&1; then
    echo "php CLI was not found on PATH" >&2
    exit 127
fi

file_list="$(mktemp "${TMPDIR:-/tmp}/p2pnow-nexus-php-files.XXXXXX")"
lint_output="$(mktemp "${TMPDIR:-/tmp}/p2pnow-nexus-php-lint.XXXXXX")"
trap 'rm -f "$file_list" "$lint_output"' EXIT HUP INT TERM

find . -type f -name '*.php' \
    ! -path './.git/*' \
    ! -path './config/allconfig.php' \
    | sort > "$file_list"

status=0

while IFS= read -r file; do
    if ! php -l "$file" >"$lint_output" 2>&1; then
        echo "PHP syntax check failed: $file" >&2
        cat "$lint_output" >&2
        status=1
    fi
done < "$file_list"

exit "$status"
