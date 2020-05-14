<?php

namespace App\Enum;

abstract class RaioXEnum
{
    const NORMAL        = 0;
    const INFILTRACAO   = 1;
    const MISTO         = 2;
    const CONSOLIDADO   = 3;
    const OUTROS        = 4;
    const NAO_REALIZADO = 5;

    public static function getTipo()
    {
        return [
            self::NORMAL            => 'Normal',
            self::INFILTRACAO       => 'Infiltração',
            self::MISTO             => 'Misto',
            self::CONSOLIDADO       => 'Consolidado',
            self::OUTROS            => 'Outros',
            self::NAO_REALIZADO     => 'Não Realizado',
        ];
    }
}