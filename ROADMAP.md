# Security and Modernization Roadmap

P2Pnow Nexus is a legacy PHP 5-era codebase. This roadmap describes the order of
work needed before maintainers can responsibly describe a release as suitable for
new deployments.

The current repository should be treated as archival and modernization-ready, not
production-ready.

## Phase 0: Baseline and Risk Freeze

- Keep the current PHP 5.6 syntax check green.
- Document supported and unsupported runtimes before making compatibility
  claims.
- Avoid broad formatting changes until core security work is complete.
- Inventory third-party code and bundled assets so future licensing work has a
  clear source list.
- Add reproducible local development instructions for the legacy runtime.

## Phase 1: Critical Security Review

Focus first on externally reachable and high-impact paths:

- Authentication, login cookies, password reset, email confirmation, and invite
  flows.
- Tracker endpoints such as announce and scrape.
- Upload paths for torrents, subtitles, attachments, images, and bitbucket
  files.
- Staff and admin panels.
- Mail delivery and external metadata scraping.
- SQL query construction, escaping, and error handling.

Expected outputs:

- A documented threat model for public and private tracker deployments.
- A list of confirmed vulnerabilities, grouped by severity.
- Focused patches with operator notes for required configuration or database
  changes.

## Phase 2: Authentication and Secret Handling

- Replace MD5-based password hashes with `password_hash()` and
  `password_verify()`.
- Add transparent password rehashing on login for existing users.
- Replace predictable MD5-derived tokens with random bytes from a cryptographic
  source.
- Review passkeys, invite keys, email confirmation secrets, promotion keys, and
  reset tokens.
- Ensure cookies use secure, HttpOnly, and SameSite attributes where supported.
- Make HTTPS the documented default for web and tracker traffic.

## Phase 3: Database Modernization

- Replace removed `mysql_*` APIs with PDO or mysqli.
- Introduce prepared statements for user-controlled input.
- Centralize database connection setup, charset handling, and SQL mode policy.
- Remove assumptions tied to magic quotes.
- Add migration notes for existing installations.

## Phase 4: Input, Upload, and Output Hardening

- Define validation rules for every request parameter at the boundary.
- Audit file upload paths for extension checks, MIME checks, generated filenames,
  storage location, and direct web access.
- Normalize escaping rules for HTML, attributes, URLs, JavaScript, SQL, and
  tracker responses.
- Add CSRF protection to state-changing web forms.
- Review permissions for staff actions and privileged workflows.

## Phase 5: Runtime Upgrade Path

- Establish a tested PHP target after the database layer has been modernized.
- Remove PHP 5-only syntax and compatibility shims.
- Replace deprecated libraries and APIs.
- Add CI jobs for the new supported PHP versions.
- Keep a legacy syntax job only while compatibility with old installations is an
  explicit maintenance goal.

## Phase 6: Test and Release Discipline

- Add focused regression tests around authentication, tracker announce logic,
  upload handling, and permission checks.
- Add database fixtures or migration smoke tests.
- Publish a support matrix for PHP, MySQL or MariaDB, memcached, and web server
  versions.
- Publish release notes that separate security fixes, compatibility changes, and
  behavior changes.

## Non-Goals for the First Modernization Pass

- Redesigning the UI.
- Rewriting the application in a different framework.
- Changing tracker rules, ratio rules, or community policy defaults unless
  required for security.
- Claiming production readiness before the security review and runtime upgrade
  path are complete.
