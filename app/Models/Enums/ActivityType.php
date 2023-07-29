<?php

namespace App\Models\Enums;


enum ActivityType: string
{

    case Running = 'running';
    case Cycling = 'cycling';
    case Walking = 'walking';
    case Swimming = 'swimming';

    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }

}
