<?php

namespace App\Models;

use App\Models\Enums\DistanceUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_type', 'activity_date', 'name', 'distance', 'distance_unit', 'elapsed_time'];

    public function getAllActivities()
    {
        return self::all();
    }

    public function getActivitiesByType($type)
    {
        return self::where('activity_type', $type)->get();
    }


    public function storeActivity($data)
    {
        return self::create($data);
    }
}
