<?php

declare(strict_types=1);

namespace App\Traits;

trait EnumToArray
{
    /**
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array<int|string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array<string>
     */
    public static function getNamesPerValues(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * @return array<int|string>
     */
    public static function getValuesPerNames(): array
    {
        return array_combine(self::names(), self::values());
    }

    /**
     * @param string $name
     *
     * @return int|string|null
     */
    public static function getValueByName(string $name): int|string|null
    {
        foreach (self::cases() as $enum) {
            if ($enum->name === $name) {
                return $enum->value;
            }
        }

        return null;
    }
}
