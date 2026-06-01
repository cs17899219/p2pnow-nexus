# Contributing

Thanks for taking the time to improve P2Pnow Nexus.

This is a legacy PHP codebase. Keep changes small, explicit, and easy to review.
Avoid mixing modernization, formatting churn, and behavior changes in the same
pull request.

## Development Guidelines

- Preserve GPL-2.0 licensing for contributed code.
- Do not commit local configuration, database dumps, uploaded torrents,
  attachments, caches, logs, or user data.
- Document runtime assumptions when changing PHP, MySQL, memcached, mail, or web
  server behavior.
- Prefer targeted fixes over broad rewrites unless a modernization plan has been
  discussed first.
- Include manual test notes for UI or tracker behavior that cannot be covered by
  automated checks yet.

## Before Opening a Pull Request

Run the available syntax check with PHP 5.6:

```sh
sh scripts/lint-php.sh
```

If PHP CLI is not available locally, say so in the pull request and describe any
manual checks you did run.

## Security Reports

Do not include exploit details, private user data, database dumps, tracker
secrets, passkeys, or production configuration in public issues or pull requests.
Follow [SECURITY.md](SECURITY.md) for vulnerability reports.
