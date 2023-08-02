<?php

namespace Tests\Unit;

use App\Models\Enums\ActivityType;
use App\Services\ActivityService;
use App\Models\Activity;
use App\Models\Enums\DistanceUnit;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;
use Mockery;

class ActivityServiceTest extends TestCase
{
    private Activity $activityModel;
    private ActivityService $activityService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->activityModel = Mockery::mock(Activity::class);
        $this->activityService = new ActivityService($this->activityModel);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    /* NOTE:
     * I ignore the below methods for testing. because they just call the Model that I tested them in ActivityTest.
     * If in the future added some logic to the service you should make their tests.
     * getAllActivities    getActivitiesByType     storeActivity
     */

    public function test_getTotalDistanceByType_returns_total_distance()
    {
        $type = ActivityType::Running;
        $activities = new Collection([
            (object) ['distance' => 1, 'distance_unit' => DistanceUnit::Kilometer->value],
            (object) ['distance' => 500, 'distance_unit' => DistanceUnit::Meter->value],
        ]);

        $this->activityModel->shouldReceive('getActivitiesByType')
            ->with($type->value)
            ->andReturn($activities);

        $totalDistance = $this->activityService->getTotalDistanceByType($type);

        $this->assertEquals(1500, $totalDistance);
    }

    public function test_getTotalTimeByType_returns_total_time()
    {
        $type = ActivityType::Running;
        $totalTimeInSeconds = 3600;

        $this->activityModel->shouldReceive('sumElapsedTimeByType')
            ->with($type->value)
            ->andReturn($totalTimeInSeconds);

        $totalTime = $this->activityService->getTotalTimeByType($type);

        $expectedTotalTime = '01:00:00';
        $this->assertEquals($expectedTotalTime, $totalTime);
    }
}