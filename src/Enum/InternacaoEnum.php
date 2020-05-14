<?php

namespace App\Enum;

abstract class InternacaoEnum
{
    const NAO = 0;
    const SIM = 1;

    public static function getTipo()
    {
        return [
            self::NAO => 'Não',
            self::SIM => 'Sim',
        ];
    }
}