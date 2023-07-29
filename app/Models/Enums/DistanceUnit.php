<?php

namespace App\Models\Enums;


enum DistanceUnit: string
{
    case Kilometer = 'kilometer';
    case Meter = 'meter';
    case Mile = 'mile';

    public function rate(): string
    {
        return match($this) {
            self::Mile => 1609.34,
            self::Kilometer => 1000,
            default => 1,
        };
    }

    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
