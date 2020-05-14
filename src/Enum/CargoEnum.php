<?php

namespace App\Enum;

abstract class CargoEnum
{
    const ROLE_SUPER_ADMIN      = 1;
    const ROLE_ADMIN            = 2;
    const ROLE_TECNICO          = 3;
    const ROLE_UNIDADE          = 4;

    public static function getCargo()
    {
        return [
            self::ROLE_SUPER_ADMIN      => 'Desenvolvedor',
            self::ROLE_ADMIN            => 'Administrador',
            self::ROLE_TECNICO          => 'Técnico',
            self::ROLE_UNIDADE          => 'Unidade',
        ];
    }
}