# Contributing

Thanks for taking the time to contribute! This document describes how to propose
changes to this package.

## Requirements

- PHP 8.1 or higher.
- [Composer](https://getcomposer.org/).

## Getting started

Fork and clone the repository, then install the dependencies:

```bash
composer install
```

## Running the checks

A single command runs the full gate — tests, static analysis, and code style:

```bash
composer check
```

You can also run each step on its own:

```bash
composer test      # PHPUnit
composer phpstan   # static analysis
composer cs        # code-style check (dry run)
composer cs-fix    # apply code-style fixes
```

Please make sure `composer check` passes before opening a pull request. CI runs the
same checks on every supported PHP version.

## Coding standards

- Follow the existing code style; run `composer cs-fix` to format your changes.
- Keep changes focused, and add tests for new behavior and bug fixes.

## Submitting changes

1. Create a branch off `main`.
2. Make your change with tests, and keep `composer check` green.
3. Write clear commit messages ([Conventional Commits](https://www.conventionalcommits.org/)
   are appreciated).
4. Update `CHANGELOG.md` for user-facing changes.
5. Open a pull request and fill in the template: describe what changes and why, and
   link any related issue.

## Reporting bugs and requesting features

Use the issue templates (Bug report / Feature request). For security issues, please
follow the [security policy](SECURITY.md) rather than opening a public issue.
