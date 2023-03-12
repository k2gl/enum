<?php declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;

interface ExtendedBackedEnumInterface
{
    public static function names(): array;

    public static function values(): array;

    public static function random(): BackedEnum;

    public function is(mixed $value): bool;

    public function not(mixed $value): bool;
}