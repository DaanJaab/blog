<?php

namespace App\Enums;

class BanReasons
{
    const REKLAMOWANIE = 1;
    const OBRAŻANIE = 2;
    const SPAM = 3;
    const OSZUSTWO = 4;
    const INNE = 9;

    const TYPES = [
        self::REKLAMOWANIE,
        self::OBRAŻANIE,
        self::SPAM,
        self::OSZUSTWO,
        self::INNE
    ];
}
