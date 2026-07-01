<?php

declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;
use ValueError;

interface ExtendedBackedEnumInterface extends BackedEnum
{
    public static function any(): static;

    /**
     * @param self|non-empty-array<static> $except
     */
    public static function anyoneExcept(BackedEnum|array $except): static;

    /**
     * @throws ValueError when no case has the given name
     */
    public static function fromName(string $name): static;

    public static function tryFromName(string $name): ?static;

    public function is(mixed $value): bool;

    public function isNot(mixed $value): bool;

    public function in(mixed ...$values): bool;

    public function notIn(mixed ...$values): bool;

    /**
     * @return list<string>
     */
    public static function names(): array;

    /**
     * @return list<int|string>
     */
    public static function values(): array;

    public function label(): string;

    /**
     * @return array<int|string, string>
     */
    public static function options(): array;

    /**
     * @return list<string>
     */
    public static function labels(): array;

    /**
     * @throws ValueError when no case has the given label
     */
    public static function fromLabel(string $label): static;

    public static function tryFromLabel(string $label): ?static;
}
