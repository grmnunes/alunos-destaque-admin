<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class EnumToArrayCast implements CastsAttributes
{
    public function __construct(private string $enumClass) {}

    public function get($model, string $key, $value, array $attributes)
    {
        $values = json_decode($value, true) ?? [];

        return array_map(fn($val) => $this->enumClass::tryFrom($val), $values);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException("O valor precisa ser um array de {$this->enumClass}.");
        }

        return json_encode(array_map(fn($enum) => $enum, $value));
    }
}
