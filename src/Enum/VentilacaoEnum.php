<?php

namespace App\Enum;

abstract class VentilacaoEnum
{
    const NAO           = 0;
    const INVASIVO      = 1;
    const NAO_IVASIVO   = 2;

    public static function getTipo()
    {
        return [
            self::NAO           => 'Não utilizado',
            self::INVASIVO      => 'Invasivo',
            self::NAO_IVASIVO   => 'Não Invasivo'
        ];
    }
}