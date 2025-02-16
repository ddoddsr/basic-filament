<?php

namespace App\Enums;

enum TypeUserEnum: string
{
    case Admin = 'ADMIN';
    case Staff = 'STAFF';
    case Client = 'CLIENT';
}