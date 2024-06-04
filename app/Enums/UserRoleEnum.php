<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case STANDARD = 'standard';
    case CANDIDATE = 'candidate';
    case ADMIN = 'admin';

    public static function getDescription(string $role): string
    {
        return match ($role) {
            self::STANDARD->value => 'Padrão',
            self::CANDIDATE->value => 'Candidato',
            self::ADMIN->value => 'Administrador',
            default => 'Desconhecido',
        };
    }
}
