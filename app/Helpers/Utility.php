<?php

namespace App\Helpers;

class Utility
{
    public static function secondToDuration(int $totalTimeInSeconds): string
    {
        $hours = floor($totalTimeInSeconds / 3600);
        $minutes = floor(($totalTimeInSeconds - ($hours * 3600)) / 60);
        $seconds = $totalTimeInSeconds - ($hours * 3600) - ($minutes * 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}