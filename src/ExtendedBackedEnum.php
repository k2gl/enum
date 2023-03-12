<?php declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;

trait ExtendedBackedEnum
{
    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function random(): self
    {
        $values = self::values();
        $key    = array_rand($values);

        return self::from($values[$key]);
    }

    public function is(mixed $value): bool
    {
        if ($value instanceof BackedEnum) {
            return $value === $this;
        }

        return $this->value === $value;
    }

    public function not(mixed $value): bool
    {
        return !$this->is($value);
    }
}