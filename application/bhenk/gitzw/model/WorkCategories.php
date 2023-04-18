<?php

namespace bhenk\gitzw\model;

enum WorkCategories: string {

    case draw = "drawing";
    case dry = "drypoint";
    case paint = "painting";

    public static function forName(?string $name): ?WorkCategories {
        foreach (WorkCategories::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

    public static function forValue(string $value): ?WorkCategories {
        foreach (WorkCategories::cases() as $case) {
            if ($case->value == $value) {
                return $case;
            }
        }
        return null;
    }

}
