<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case CLIENT = 'client';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
