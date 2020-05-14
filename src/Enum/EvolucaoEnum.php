<?php

namespace App\Enum;

abstract class EvolucaoEnum
{
    const VAZIO         = 0;
    const OBITO         = 1;
    const ALTA          = 2;
    const TRANSFERIDO   = 3;

    public static function getTipo()
    {
        return [
            self::VAZIO         => 'Não informado',
            self::OBITO         => 'Óbito',
            self::ALTA          => 'Alta',
            self::TRANSFERIDO   => 'Transferido'
        ];
    }
}