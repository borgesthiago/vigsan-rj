<?php

namespace App\Enum;

abstract class StatusCidadaoEnum
{
    const DESCARTADO       = 0;
    const CONFIRMADO       = 1;

    public static function getStatus()
    {
        return [
            self::DESCARTADO       => 'DESCARTADO',
            self::CONFIRMADO       => 'CONFIRMADO',
        ];
    }
}