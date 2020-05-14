<?php

namespace App\Enum;

abstract class RolesEnum
{
    const ROLE_SUPER_ADMIN      = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN            = 'ROLE_ADMIN';
    const ROLE_AUTORIZATARIO    = 'ROLE_AUTORIZATARIO';
    const ROLE_FISCALIZAÇÃO     = 'ROLE_FISCAL';
    const ROLE_FUNCIONARIO      = 'ROLE_FUNCIONARIO';

    public static function getRoles()
    {
        return [
            'Autorizatário' => self::ROLE_AUTORIZATARIO,
            'Fiscalização'  => self::ROLE_FISCALIZAÇÃO,
            'Funcionário'   => self::ROLE_FUNCIONARIO,
            'Administrador' => self::ROLE_ADMIN,
            'Dev'           => self::ROLE_SUPER_ADMIN,
        ];
    }
}