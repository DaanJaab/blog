<?php

namespace App\Enums;

class UserRole
{
    const ADMIN = 'admin';
    const MODER = 'moder';
    const USER = 'user';

    const TYPES = [
        self::ADMIN,
        self::MODER,
        self::USER
    ];
}
