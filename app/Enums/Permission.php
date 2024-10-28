<?php

namespace App\Enums;

enum Permission: string
{
    case VIEWANY = 'View-Any';
    case VIEW = 'View';
    case CREATE = 'Create';
    case UPDATE = 'Update';
    case DELETE = 'Delete';
    case RESTORE = 'Restore';
    case FORCEDELETE = 'Force-Delete';
}