<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StageControllerTest extends TestCase
{
    public function testAll()
{
    $stageData = [
        'name' => 'Test Stage 01',
        'comment' => 'Test Comment',
        'conference_id' => 2,
    ];

    $response = $this->postJson('/api/stages', $stageData);

    //$response->dump(); // Print the response to the console

    $this->assertDatabaseHas('stages', [
        'name' => 'Test Stage 01',
        'comment' => 'Test Comment',
        'conference_id' => 2,
    ]);
}

    public function testRequired()
    {
        $stageData = [
            'name' => 'Test Stage 02',
            'conference_id' => 2,
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 02',
            'comment' => null,
            'conference_id' => 2,
        ]);
    }

    public function testNoName()
    {
        $stageData = [
            'conference_id' => 2,
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function testNoConferenceId()
    {
        $stageData = [
            'name' => 'Test Stage 03',
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('conference_id');
    }

    public function testEdit()
    {
        $stageData = [
            'name' => 'Test Stage 04',
            'comment' => 'Test Comment',
            'conference_id' => 1,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $stageId = 3;

        $stageData = [
            'name' => 'Test Stage 04_2',
            'comment' => 'Test Comment 2',
            'conference_id' => 1,
        ];

        $response = $this->putJson('/api/stages/' . $stageId, $stageData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 04_2',
            'comment' => 'Test Comment 2',
            'conference_id' => 1,
        ]);

        $response->assertStatus(200);

        $response = $this->get('/api/stages/' . $stageId);
    }
}
