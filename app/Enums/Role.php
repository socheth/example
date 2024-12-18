<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'Super Admin';
    case ADMIN = 'Admin';
    case MANAGER = 'Manager';
    case AUTHOR = 'Author';
    case USER = 'User';
}
