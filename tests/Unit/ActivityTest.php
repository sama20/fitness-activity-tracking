<?php

namespace Tests\Unit;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    private Activity $activity;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->activity = new Activity();
    }

    protected function setUp(): void
    {
        parent::setUp();

        Activity::factory()->create([
            'activity_type' => 'running',
            'elapsed_time' => 1000,
        ]);

        Activity::factory()->create([
            'activity_type' => 'running',
            'elapsed_time' => 1500,
        ]);

        Activity::factory()->create([
            'activity_type' => 'cycling',
            'elapsed_time' => 2000,
        ]);
    }

    public function test_it_can_get_all_activities()
    {
        $allActivities = $this->activity->getAllActivities();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $allActivities);
        $this->assertCount(3, $allActivities);
    }

    public function test_it_can_get_activities_by_type()
    {
        $runningActivities = $this->activity->getActivitiesByType('running');

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $runningActivities);
        $this->assertCount(2, $runningActivities);
    }

    public function test_it_can_create_activity(): void
    {
        $this->activity = Activity::factory()->create();

        $this->assertInstanceOf(Activity::class, $this->activity);
    }

    public function test_it_can_sum_elapsed_time_by_type()
    {
        $totalElapsedTimeRunningAfter = $this->activity->sumElapsedTimeByType('running');

        $this->assertEquals(2500, $totalElapsedTimeRunningAfter);
    }
}
