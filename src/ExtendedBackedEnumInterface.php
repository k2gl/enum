<?php declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;

interface ExtendedBackedEnumInterface
{
    public static function any(): static;

    /**
     * @param self|non-empty-array<static> $except
     */
    public static function anyoneExcept(BackedEnum|array $except): static;

    public function is(mixed $value): bool;

    public function isNot(mixed $value): bool;

    public static function names(): array;

    public static function values(): array;
}