<?php

namespace App\Enums;

enum SchoolSessions: string
{
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';
    case NIGHT = 'night';
    case FULL = 'full';

    public static function options(): array
    {
        return [
            self::MORNING->value => 'Manhã',
            self::AFTERNOON->value => 'Tarde',
            self::NIGHT->value => 'Noite',
            self::FULL->value => 'Integral'
        ];
    }
}
