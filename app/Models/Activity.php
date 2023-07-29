<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_type', 'activity_date', 'name', 'distance', 'distance_unit', 'elapsed_time'];

    public function getAllActivities(): Collection
    {
        return self::all();
    }

    public function getActivitiesByType($type): Collection
    {
        return self::where('activity_type', $type)->get();
    }

    public function sumElapsedTimeByType($type): int
    {
        return self::where('activity_type', $type)->sum('elapsed_time');
    }

    public function storeActivity($data): Activity
    {
        return self::create($data);
    }
}
