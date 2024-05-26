<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Time_tableControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAll()
    {
        $time_tableData = [
            'time_start' => '08:00:00',
            'time_end' => '09:00:00',
            'stage_id' => 1,
            'comment' => 'Test Comment',
        ];

        $response = $this->postJson('/api/time_tables', $time_tableData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('time_tables', [
            'time_start' => '08:00:00',
            'time_end' => '09:00:00',
            'stage_id' => 1,
            'comment' => 'Test Comment',
        ]);
    }

    public function testRequired()
    {
        $time_tableData = [
            'time_start' => '09:00:00',
            'time_end' => '10:00:00',
            'stage_id' => 2,
        ];
    
        $response = $this->postJson('/api/time_tables', $time_tableData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '09:00:00',
            'time_end' => '10:00:00',
            'stage_id' => 2,
            'comment' => null,
        ]);
    }

    public function testNoTimeStart()
    {
        $time_tableData = [
            'time_end' => '10:00:00',
            'stage_id' => 2,
        ];
    
        $response = $this->postJson('/api/time_tables', $time_tableData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('time_start');
    }

    public function testNoTimeEnd()
    {
        $time_tableData = [
            'time_start' => '09:00:00',
            'stage_id' => 2,
        ];
    
        $response = $this->postJson('/api/time_tables', $time_tableData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('time_end');
    }

    public function testNoStageId()
    {
        $time_tableData = [
            'time_start' => '09:00:00',
            'time_end' => '10:00:00',
        ];
    
        $response = $this->postJson('/api/time_tables', $time_tableData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('stage_id');
    }

    public function testEdit()
    {
        $time_tableData = [
            'time_start' => '10:00:00',
            'time_end' => '11:00:00',
            'stage_id' => 2,
            'comment' => 'Test Comment3',
        ];

        $response = $this->postJson('/api/time_tables', $time_tableData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $timeTableId = 3;
        
        $time_tableData = [
            'time_start' => '11:00:00',
            'time_end' => '12:00:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 04',
        ];

        $response = $this->putJson('/api/time_tables/' . $timeTableId, $time_tableData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('time_tables', [
            'time_start' => '11:00:00',
            'time_end' => '12:00:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 04',
        ]);

        $response->assertStatus(200);

    }
    
    public function testEditnoStage()
    {
        $time_tableData = [
            'time_start' => '10:00:00',
            'time_end' => '11:00:00',
            'stage_id' => 2,
            'comment' => 'Test Comment3',
        ];

        $response = $this->postJson('/api/time_tables', $time_tableData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $timeTableId = 3;
        
        $time_tableData = [
            'time_start' => '11:00:00',
            'time_end' => '12:00:00',
            'comment' => 'Test Comment 04',
        ];

        $response = $this->putJson('/api/time_tables/' . $timeTableId, $time_tableData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('stage_id');

        //test delete
        $response = $this->deleteJson('/api/time_tables/' . $timeTableId);
        $response->assertStatus(200);
        

    }
}
