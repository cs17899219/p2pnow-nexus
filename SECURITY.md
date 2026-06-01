# Security Policy

## Supported Status

P2Pnow Nexus is currently a legacy codebase under open source preparation. It
should be treated as unsupported for production use until maintainers publish a
clear supported release and runtime matrix.

The current repository state is best suited for review, archival use, and
modernization work.

See [ROADMAP.md](ROADMAP.md) for the security and modernization sequence needed
before new production deployments should be considered.

## Reporting a Vulnerability

Please avoid publishing exploit details in public issues.

Preferred reporting path:

1. Use GitHub private vulnerability reporting if it is enabled for the
   repository.
2. If private reporting is unavailable, open a public issue with a short
   non-exploit summary asking maintainers to establish a private contact path.

Do not attach database dumps, real user data, tracker passkeys, production
configuration files, or secrets to any report.

## Scope

Security-sensitive areas include:

- Authentication and password reset flows.
- Invite and signup flows.
- Tracker announce and scrape endpoints.
- Upload, subtitle, attachment, and image handling.
- SQL query construction and escaping.
- Staff/admin panels.
- Mail delivery and external metadata scraping.

Maintainers should handle security fixes in focused patches and document any
required operator action, such as configuration changes or database migrations.
