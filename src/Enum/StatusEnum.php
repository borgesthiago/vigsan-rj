<?php

namespace App\Enum;

abstract class StatusEnum
{
    const INATIVO       = 0;
    const ATIVO         = 1;

    public static function getStatus()
    {
        return [
            self::ATIVO         => 'Ativo',
            self::INATIVO       => 'Inativo',
        ];
    }
}