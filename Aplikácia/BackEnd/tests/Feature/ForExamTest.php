<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForExamTest extends TestCase
{
///////////////////Conference/////////////////////
    public function test_Conference_All()
    {
        $conferenceData = [
            'name' => 'Test Conference 01',
            'date' => '2022-12-31',
            'comment' => 'Test Comment',
            'address' => 'Test Address',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('conferences', [
            'name' => 'Test Conference 01',
            'date' => '2022-12-31',
            'state' => 'preparing',
            'comment' => 'Test Comment',
            'address_of_conference' => 'Test Address',
        ]);
    }

    public function test_Conference_required()
    {
        $conferenceData = [
            'name' => 'Test Conference 02',
            'date' => '2024-12-31',
        ];
    
        $response = $this->postJson('/api/conferences', $conferenceData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('conferences', [
            'name' => 'Test Conference 02',
            'date' => '2024-12-31',
            'state' => 'preparing',
            'comment' => null,
            'address_of_conference' => null,
        ]);
    }

    public function test_Conference_Noname()
    {
        $conferenceData = [
            'date' => '2022-12-31',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_Conference_Nodate()
    {
        $conferenceData = [
            'name' => 'Test Conference 03',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('date');
    }

    public function test_Conference_NoNothing()
    {
        $conferenceData = [
            'comment' => 'Test Comment',
            'address' => 'Test Address',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        //$response->assertJsonValidationErrors('name');
        //$response->assertJsonValidationErrors('date');

        $response->assertJsonValidationErrors(['name', 'date']);
    }
    
    public function test_Conference_Comment()
    {
            // Get the ID of the created conference
        $conferenceId = 2;

        // Define the new data
        $newData = [
            'name' => 'Test Conference 02',
            'date' => '2025-12-31',
            'state' => 'in_progress',   
            'comment' => 'Test Comment',
        ];

        // Send a PUT request to the update endpoint
        $response = $this->putJson("/api/conferences/{$conferenceId}", $newData);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        //$response->dump(); // Print the response to the console

        // Assert that the conference was updated in the database
        $this->assertDatabaseHas('conferences', array_merge(['id' => $conferenceId], $newData));
    }

    public function test_Conference_Edit()
    {
        // Define the initial data
        $initialData = [
            'name' => 'Test Conference 3',
            'date' => '2026-12-31',
            'address_of_conference' => 'Test Address',
        ];

        // Send a POST request to the store endpoint
        $response = $this->postJson('/api/conferences', $initialData);

        // Assert that the response status is 201 (Created)
        $response->assertStatus(201);

        // Get the ID of the created conference
        $conferenceId = 3;

        // Define the new data
        $newData = [
            'name' => 'Test Conference 03',
            'date' => '2026-12-31',
            'state' => 'ended',
            'address_of_conference' => 'Test Address',
        ];

        // Send a PUT request to the update endpoint
        $response = $this->putJson("/api/conferences/{$conferenceId}", $newData);

        //$response->dump(); // Print the response to the console

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the conference was updated in the database
        $this->assertDatabaseHas('conferences', array_merge(['id' => $conferenceId], $newData));
    }
    ///////////////////Conference/////////////////////

    //////////////////////Stage/////////////////////
    public function test_Stage_All()
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

    public function test_Stage_Required()
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

    public function test_Stage_NoName()
    {
        $stageData = [
            'conference_id' => 2,
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_Stage_NoConferenceId()
    {
        $stageData = [
            'name' => 'Test Stage 03',
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('conference_id');
    }

    public function test_Stage_Edit()
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
    //////////////////////Stage/////////////////////

    //////////////////////Time_table/////////////////////
    public function test_TimeTable_All()
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

    public function test_TimeTable_Required()
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

    public function test_TimeTable_NoTimeStart()
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

    public function test_TimeTable_NoTimeEnd()
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

    public function test_TimeTable_NoStageId()
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

    public function test_TimeTable_Edit()
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
    
    public function test_TimeTable_EditnoStage()
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
    //////////////////////Time_table/////////////////////

    //////////////////////Presentation/////////////////////
    public function test_Presentation_All()
    {
        $presentationData = [
            'name' => 'Test Name',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 100,
            'time_table_id' => 1,
            'comment' => 'Test Comment',
        ];

        $response = $this->postJson('/api/presentations', $presentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 100,
            'time_table_id' => 1,
            'comment' => 'Test Comment',
        ]);
    }

    public function test_Presentation_Required()
    {
        $presentationData = [
            'name' => 'Test Name2',
            'max_capacity' => 100,
            'time_table_id' => 2,
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name2',
            'short_description' => null,
            'long_description' => null,
            'max_capacity' => 100,
            'time_table_id' => 2,
            'comment' => null,
        ]);
    }

    public function test_Presentation_NoName()
    {
        $presentationData = [
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 100,
            'time_table_id' => 2,
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function test_Presentation_NoMaxCapacity()
    {
        $presentationData = [
            'name' => 'Test Name',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'time_table_id' => 2,
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('max_capacity');
    }

    public function test_Presentation_NoTimeTableId()
    {
        $presentationData = [
            'name' => 'Test Name',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 100,
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('time_table_id');
    }

    public function test_Presentation_Edit()
    {
        $presentationData = [
            'name' => 'Test Name3',
            'short_description' => 'Test Short Description3',
            'long_description' => 'Test Long Description3',
            'max_capacity' => 200,
            'time_table_id' => 2,
            'comment' => 'Test Comment3',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $presentationId = 3;

        $presentationData = [
            'name' => 'Test Name4',
            'short_description' => 'Test Short Description4',
            'long_description' => 'Test Long Description4',
            'max_capacity' => 400,
            'time_table_id' => 4,
            'comment' => 'Test Comment4',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $presentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name4',
            'short_description' => 'Test Short Description4',
            'long_description' => 'Test Long Description4',
            'max_capacity' => 400,
            'time_table_id' => 4,
            'comment' => 'Test Comment4',
        ]);

        $response->assertStatus(200);
    }
    //////////////////////Presentation/////////////////////
}