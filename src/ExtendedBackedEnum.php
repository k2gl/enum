<?php

declare(strict_types=1);

namespace K2gl\Enum;

use BackedEnum;
use ValueError;

/**
 * @phpstan-require-implements ExtendedBackedEnumInterface
 */
trait ExtendedBackedEnum
{
    public static function any(): static
    {
        $values = self::values();
        $key    = \array_rand($values);

        return self::from($values[$key]);
    }

    /**
     * @param self|non-empty-array<static> $except
     */
    public static function anyoneExcept(BackedEnum|array $except): static
    {
        if (\is_array($except)) {
            $exceptValues = [];

            foreach ($except as $value) {
                $exceptValues[] = $value->value;
            }
        } else {
            $exceptValues = [$except->value];
        }

        $values = \array_diff(self::values(), $exceptValues);

        if (! $values) {
            throw new ValueError('All possible values excluded');
        }

        return self::from($values[\array_rand($values)]);
    }

    /**
     * Resolve a case by its name, mirroring the native from() which only
     * resolves by backing value.
     *
     * @throws ValueError when no case has the given name
     */
    public static function fromName(string $name): static
    {
        return self::tryFromName($name)
            ?? throw new ValueError(
                sprintf('"%s" is not a valid name for enum %s', $name, self::class)
            );
    }

    public static function tryFromName(string $name): ?static
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        return null;
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
        return ! $this->is($value);
    }

    /**
     * @return list<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return list<value-of<static>>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
