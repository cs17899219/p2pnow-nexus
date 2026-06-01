#!/bin/sh
set -eu

fail=0

report_failure() {
    echo "SECURITY REGRESSION: $1" >&2
    fail=1
}

if rg -n 'preg_replace\([^\n]*\/(e|ei|ie|eis|ies)["'\'']' --glob '*.php' .; then
    report_failure "preg_replace /e modifier is executable code and must not be used"
fi

if rg -n 'chr\(mt_rand\(100, 120\)|newpassword \.= \$chars\[mt_rand' include/functions.php recover.php; then
    report_failure "security tokens and reset passwords must use a cryptographically secure generator"
fi

if rg -n '(^|[^_[:alnum:]])setcookie\("c_secure_(uid|pass|ssl|tracker_ssl|login)"' include/functions.php; then
    report_failure "sensitive auth cookies must go through the hardened cookie helper"
fi

if rg -n 'Content-Disposition: attachment; filename=\\?"?\$[^)]*\[' download.php getattachment.php downloadsubs.php; then
    report_failure "download filenames must be sanitized before entering Content-Disposition headers"
fi

if rg -n 'header\("Location: \$redir"\)|header\("Location: " \. \$pprefix \. "\$BASEURL/\$_POST\[returnto\]"' adredir.php takelogin.php; then
    report_failure "redirect targets must be validated before use"
fi

exit "$fail"
