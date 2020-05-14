<?php

namespace App\Enum;

abstract class ResultadoExameEnum
{
    const VAZIO             = 0;
    const DETECTAVEL        = 1;
    const INDETECTAVEL      = 2;
    const NAO_REALIZADO     = 3;
    const INCONCLUSIVO      = 4;

    public static function getTipo()
    {
        return [
            self::VAZIO           => 'Não informado',
            self::DETECTAVEL      => 'Detectável',
            self::INDETECTAVEL    => 'Indetectável',
            self::NAO_REALIZADO   => 'Não Realizado',
            self::INCONCLUSIVO    => 'Inconclusivo'
        ];
    }
}