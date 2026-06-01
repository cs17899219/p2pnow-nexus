# P2Pnow Nexus

P2Pnow Nexus is a legacy PHP private tracker application. It originated as a fork of TBSource, NexusPHP, and other open source tracker projects.

The source code is distributed under the GNU General Public License version 2. See [LICENSE](LICENSE) for the full license text.

## Project Status

This repository contains legacy code that was originally built for the PHP 5 era. It is useful as an archival codebase and as a starting point for modernization work, but it should not be deployed to the public internet without a full security review and runtime compatibility pass.

Known baseline:

- PHP 5.2 or 5.3 was the original tested runtime.
- The application uses the removed `mysql` PHP extension.
- Apache, MySQL, memcached, GD, mbstring, and memcache were part of the original stack.
- Modern PHP deployments will require porting work, especially from `mysql_*` calls to `mysqli` or PDO.

See [ROADMAP.md](ROADMAP.md) for the security and modernization sequence.

## Repository Layout

- `_db/` - database schema.
- `config/` - local configuration template and runtime configuration.
- `include/`, `classes/` - shared application code.
- `lang/` - language packs.
- `pic/`, `styles/` - static assets and themes.
- `attachments/`, `bitbucket/`, `subs/`, `torrents/`, `imdb/cache/`, `imdb/images/` - runtime data directories.

## Setup Overview

1. Prepare a legacy-compatible PHP environment. See [INSTALL](INSTALL) for the original deployment notes and the safer open source checklist.
2. Create a MySQL database and import `_db/dbstructure.sql`.
3. Copy `config/allconfig.example.php` to `config/allconfig.php`.
4. Edit `config/allconfig.php` with your local database, site URL, mail, and tracker settings.
5. Make only the runtime data directories writable by the web server user.
6. Configure the web server so `_db/`, `config/`, and other non-public directories cannot be served directly.

Do not commit `config/allconfig.php`, database dumps, uploaded torrents, attachments, cache files, or production logs.

## Development Checks

The repository includes a minimal syntax-check entry point:

```sh
sh scripts/lint-php.sh
```

The check requires a PHP CLI binary on `PATH`. Use PHP 5.6 for the current baseline syntax check. Because this project is legacy PHP, passing a syntax check does not mean the application is secure or compatible with modern PHP runtimes.

## Contributing

Contributions should keep the legacy constraints visible and avoid mixing broad modernization work with unrelated behavior changes. See [CONTRIBUTING.md](CONTRIBUTING.md).

## Security

Please do not report exploitable vulnerabilities with full details in public issues. See [SECURITY.md](SECURITY.md) for the disclosure process and current support expectations.
