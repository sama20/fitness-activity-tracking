<?php

namespace Tests\Unit;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseTransactions;
    private Activity $activity;
    private int $totalElapsedTimeRunningBefore = 0;
    private Collection $allActivitiesBefore ;
    private Collection $runningActivitiesBefore ;
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->activity = new Activity();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->totalElapsedTimeRunningBefore = $this->activity->sumElapsedTimeByType('running');
        $this->allActivitiesBefore = $this->activity->getAllActivities();
        $this->runningActivitiesBefore = $this->activity->getActivitiesByType('running');

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
        $this->assertEquals(3, count($allActivities)-count($this->allActivitiesBefore));
    }

    public function test_it_can_get_activities_by_type()
    {
        $runningActivities = $this->activity->getActivitiesByType('running');

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $runningActivities);
        $this->assertEquals(2, count($runningActivities)-count($this->runningActivitiesBefore));
    }

    public function test_it_can_create_activity(): void
    {
        $this->activity = Activity::factory()->create();
        $this->assertInstanceOf(Activity::class, $this->activity);
    }

    public function test_it_can_sum_elapsed_time_by_type()
    {
        $totalElapsedTimeRunningAfter = $this->activity->sumElapsedTimeByType('running');
        $this->assertEquals(2500, $totalElapsedTimeRunningAfter - $this->totalElapsedTimeRunningBefore);
    }
}
