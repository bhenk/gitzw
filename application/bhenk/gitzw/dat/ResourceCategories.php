<?php

namespace bhenk\gitzw\dat;

enum ResourceCategories: string {

    case draw = "drawing";
    case dry = "drypoint";
    case paint = "painting";

    public static function forName(string $name): ?ResourceCategories {
        foreach (ResourceCategories::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

    public static function forValue(string $value): ?ResourceCategories {
        foreach (ResourceCategories::cases() as $case) {
            if ($case->value == $value) {
                return $case;
            }
        }
        return null;
    }

}
