<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class SelectOptions
{

    public static function toSelectOptions(array $values, string|int|null $label = null, string|int|null $value = null): Collection {
        return collect($values)->map(function ($v) use($label, $value) {
            $label = $label ? $v[$label] : $v;
            $value = $value ? $v[$value] : $v;
            return [ "label" => $label, "value" => $value ];
        });
    }

}
