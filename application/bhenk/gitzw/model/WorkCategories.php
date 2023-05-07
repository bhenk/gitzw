<?php

namespace bhenk\gitzw\model;

enum WorkCategories: string {

    case draw = "drawing";
    case dry = "drypoint";
    case paint = "painting";

    /**
     * Get WorkCategory by name: draw, dry, paint
     * @param string|null $name
     * @return WorkCategories|null
     */
    public static function forName(?string $name): ?WorkCategories {
        foreach (WorkCategories::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

    /**
     * Get WorkCategory by value: "drawing", "drypoint", "painting"
     * @param string $value
     * @return WorkCategories|null
     */
    public static function forValue(string $value): ?WorkCategories {
        foreach (WorkCategories::cases() as $case) {
            if ($case->value == $value) {
                return $case;
            }
        }
        return null;
    }

    /**
     * Get WorkCategory by name or by value
     * @param string $s
     * @return WorkCategories|null
     */
    public static function get(string $s): ?WorkCategories {
        return self::forValue($s) ?? self::forName($s);
    }

}
