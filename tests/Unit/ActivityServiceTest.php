<?php
namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Enums\ActivityType;
use App\Models\Enums\DistanceUnit;
use App\Services\ActivityService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ActivityServiceTest extends TestCase
{
    use DatabaseTransactions;
    private ActivityService $activityService;
    private int $totalTimeBefore = 0;
    private Collection $allActivitiesBefore ;
    private Collection $runningActivitiesBefore ;

    private int $totalDistanceBefore;

    private Activity $sampleActivity;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->activityService = new ActivityService(new Activity());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->allActivitiesBefore = $this->activityService->getAllActivities();
        $this->runningActivitiesBefore = $this->activityService->getActivitiesByType(ActivityType::Running->value);
        $this->totalDistanceBefore = $this->activityService->getTotalDistanceByType(ActivityType::Running->value);
        $this->totalTimeBefore = strtotime($this->activityService->getTotalTimeByType(ActivityType::Running->value));


        // Seed the database with some known data for testing
        $this->sampleActivity = Activity::factory()->create([
            'activity_type' => ActivityType::Running,
            'elapsed_time' => 1000,
            'distance_unit' => DistanceUnit::Kilometer,
            'distance' => 2,
        ]);

        Activity::factory()->create([
            'activity_type' => ActivityType::Running,
            'elapsed_time' => 2600,
            'distance_unit' => DistanceUnit::Meter,
            'distance' => 700,
        ]);

        Activity::factory()->create([
            'activity_type' => ActivityType::Cycling,
            'elapsed_time' => 1100,
        ]);
    }

    public function test_it_can_get_all_activities()
    {

        $allActivities = $this->activityService->getAllActivities();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $allActivities);
        $this->assertEquals(3, count($allActivities) - count($this->allActivitiesBefore));
    }

    public function test_it_can_get_activities_by_type()
    {
        $runningActivities = $this->activityService->getActivitiesByType(ActivityType::Running->value);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $runningActivities);
        $this->assertEquals(2, count($runningActivities) - count($this->runningActivitiesBefore));
    }

    public function test_it_can_get_total_distance_by_type()
    {
        $totalDistance = $this->activityService->getTotalDistanceByType(ActivityType::Running->value);

        $this->assertEquals(2700, floor($totalDistance - $this->totalDistanceBefore) ); // Assuming distance_unit is in 'km'
    }

    public function test_it_can_get_total_time_by_type()
    {
        $totalTime = $this->activityService->getTotalTimeByType(ActivityType::Running->value);

        $this->assertEquals(3600, strtotime($totalTime)- $this->totalTimeBefore);
    }

    public function test_it_can_store_activity()
    {
        $this->assertInstanceOf(Activity::class, $this->sampleActivity);
        $this->assertEquals(1000, $this->sampleActivity->elapsed_time);
    }
}
