<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, WithFaker;

    private array $validData = [
        'activity_type' => 'running',
        'activity_date' => '2023-07-31',
        'name' => 'Morning Run',
        'distance' => 5.2,
        'distance_unit' => 'kilometer',
        'elapsed_time' => 500,
    ];

    public function test_Store_ValidData()
    {
        $response = $this->postJson('/api/activities', $this->validData);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['id', 'activity_type', 'activity_date', 'name', 'distance', 'distance_unit', 'elapsed_time']);
    }

    public function test_Store_InvalidData()
    {
        $invalidData = [
            ...$this->validData, 'activity_type'=>'bad_activity'
        ];

        $response = $this->postJson('/api/activities', $invalidData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure(['error', 'message']);
    }
}