# Changelog

All notable changes to this package are documented here. The format is based on
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project
adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.3.0] - 2026-06-13

### Added

- `in()` and `notIn()` for set membership, mirroring `is()`/`isNot()`: variadic,
  accepting cases or raw backing values (mixable), e.g. `$status->in(A, B)` or
  `$status->in(...$cases)`.

## [2.2.0] - 2026-06-13

### Added

- `#[Label]` attribute to attach a human-readable label to an enum case.
- `label()` returning a case's label, falling back to the raw case name when no
  `#[Label]` is present.
- `options()` returning a `value => label` map for the whole enum, ready for an
  HTML `<select>` or a Symfony `ChoiceType` (via `array_flip()`).

## [2.1.0] - 2026-06-05

### Added

- `fromName()` and `tryFromName()` to resolve a case by its name, the
  counterpart of the native `from()`/`tryFrom()` which only resolve by value.

### Changed

- Raised PHPStan analysis to level 9.

## [2.0.2] - 2026-05-27

### Changed

- Refreshed the toolchain: PHPUnit 10–12, current PHPStan, CI matrix across
  PHP 8.1–8.5, and adopted Laravel Pint for code style.

## [2.0.0] - 2023-10-08

### Changed

- Reworked the public API around the `ExtendedBackedEnum` trait and
  `ExtendedBackedEnumInterface`.

## [1.0.0] - 2023-03-13

### Added

- Initial release: `any()`, `anyoneExcept()`, `is()`/`isNot()`, `names()`,
  `values()`.

[2.3.0]: https://github.com/k2gl/enum/compare/2.2.0...2.3.0
[2.2.0]: https://github.com/k2gl/enum/compare/2.1.0...2.2.0
[2.1.0]: https://github.com/k2gl/enum/compare/2.0.2...2.1.0
[2.0.2]: https://github.com/k2gl/enum/compare/2.0.0...2.0.2
[2.0.0]: https://github.com/k2gl/enum/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/k2gl/enum/releases/tag/1.0.0
