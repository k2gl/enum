<?php declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;

use ValueError;

use function array_diff;
use function array_rand;
use function is_array;

trait ExtendedBackedEnum
{
    public static function any(): static
    {
        $values = self::values();
        $key    = array_rand($values);

        return self::from($values[$key]);
    }

    /**
     * @param self|non-empty-array<static> $except
     */
    public static function anyoneExcept(BackedEnum|array $except): static
    {
        if (is_array($except)) {
            $exceptValues = [];

            foreach ($except as $value) {
                $exceptValues[] = $value->value;
            }
        } else {
            $exceptValues = [$except->value];
        }

        $values = array_diff(self::values(), $exceptValues);

        if (!$values) {
            throw new ValueError('All possible values excluded');
        }

        return self::from($values[array_rand($values)]);
    }

    public function is(mixed $value): bool
    {
        if ($value instanceof BackedEnum) {
            return $value === $this;
        }

        return $this->value === $value;
    }

    public function isNot(mixed $value): bool
    {
        return !$this->is($value);
    }

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
}