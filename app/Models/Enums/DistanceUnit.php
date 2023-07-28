<?php

namespace App\Models\Enums;


enum DistanceUnit: string
{
    case Kilometer = 'Kilometer';
    case Meter = 'Meter';
    case Mile = 'Mile';

    public function rate(): string
    {
        return match($this) {
            self::Mile => 1609.34,
            self::Kilometer => 1000,
            default => 1,
        };
    }
}
