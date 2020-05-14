<?php

namespace App\Enum;

abstract class SexoEnum
{
    const F = 'F';
    const M = 'M';

    public static function getTipo()
    {
        return [
            self::F => 'F',
            self::M => 'M',
        ];
    }
}