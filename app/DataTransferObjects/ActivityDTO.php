<?php

namespace App\DataTransferObjects;

use App\Models\Enums\ActivityType;
use App\Models\Enums\DistanceUnit;

final class ActivityDTO extends AbstractDTO
{
        private string|ActivityType $activity_type;
        private string $activity_date;
        private string $name;
        private float $distance;
        private string|DistanceUnit $distance_unit;
        private int $elapsed_time;


    public function getActivityType(): ActivityType
    {
        if ($this->activity_type instanceof ActivityType) {
            return $this->activity_type;
        }

        return ActivityType::tryFrom($this->activity_type);
    }

    public function setActivityType(string|ActivityType $activity_type): void
    {
        $this->activity_type = $activity_type;
    }

    public function getActivityDate(): string
    {
        return $this->activity_date;
    }

    public function setActivityDate(string $activity_date): void
    {
        $this->activity_date = $activity_date;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    public function getDistanceUnit(): DistanceUnit
    {
        if ($this->distance_unit instanceof DistanceUnit) {
            return $this->distance_unit;
        }

        return DistanceUnit::tryFrom($this->distance_unit);
    }

    public function setDistanceUnit(string $distance_unit): void
    {
        $this->distance_unit = $distance_unit;
    }

    public function getElapsedTime(): int
    {
        return $this->elapsed_time;
    }

    public function setElapsedTime(int $elapsed_time): void
    {
        $this->elapsed_time = $elapsed_time;
    }


    /* NOTE: it is good to move this function to resource in future if needed */
    public function makeActivityDTOFromArray(array $inputs): self
    {
        $this->setActivityType($inputs['activity_type']);
        $this->setActivityDate($inputs['activity_date']);
        $this->setName($inputs['name']);
        $this->setDistance($inputs['distance']);
        $this->setDistanceUnit($inputs['distance_unit']);
        $this->setElapsedTime($inputs['elapsed_time']);
        return $this;
    }

}