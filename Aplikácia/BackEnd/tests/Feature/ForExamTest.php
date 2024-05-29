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
            'name' => 'Test konferencia 01',
            'date' => '2020-12-31',
            'comment' => 'Test kommentár',
            'address' => 'Test address',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('conferences', [
            'name' => 'Test konferencia 01',
            'date' => '2020-12-31',
            'state' => 'preparing',
            'comment' => 'Test kommentár',
            'address_of_conference' => 'Test address',
        ]);
    }

    public function test_Conference_required()
    {
        $conferenceData = [
            'name' => 'Test konferencia 02',
            'date' => '2020-12-31',
        ];
    
        $response = $this->postJson('/api/conferences', $conferenceData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('conferences', [
            'name' => 'Test konferencia 02',
            'date' => '2020-12-31',
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

    public function test_Conference_Edit_in_progress()
    {
        // Get the ID of the created conference
        $conferenceId = 2;

        // Define the new data
        $newData = [
            'name' => 'Test konferencia 02',
            'date' => '2021-12-31',
            'state' => 'in_progress',
            'comment' => 'Test Comment',
        ];

        // Send a PUT request to the update endpoint
        $response = $this->putJson("/api/conferences/{$conferenceId}", $newData);

        //$response->dump(); // Print the response to the console

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the conference was updated in the database
        $this->assertDatabaseHas('conferences', [
            'name' => 'Test konferencia 02',
            'date' => '2021-12-31',
            'state' => 'in_progress',
            'comment' => 'Test Comment',
            'address_of_conference' => null,
        ]);
    }

    public function test_Conference_Edit_ended()
    {
        $conferenceData = [
            'name' => 'Test konferencia 03',
            'date' => '2021-12-31',
            'address' => 'Test address',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('conferences', [
            'name' => 'Test konferencia 03',
            'date' => '2021-12-31',
            'state' => 'preparing',
            'comment' => null,
            'address_of_conference' => 'Test address',
        ]);

        $conferenceId = 3;

        $newData = [
            'name' => 'Test konferencia 03',
            'date' => '2022-12-31',
            'state' => 'ended',
            'comment' => 'Test Comment',
        ];

        $response = $this->putJson("/api/conferences/{$conferenceId}", $newData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(200);

        $this->assertDatabaseHas('conferences', [
            'name' => 'Test konferencia 03',
            'date' => '2022-12-31',
            'state' => 'ended',
            'comment' => 'Test Comment',
            'address_of_conference' => 'Test address',
        ]);
    }
    ///////////////////Conference/////////////////////

    //////////////////////Stage/////////////////////
    public function test_Stage_All()
    {
        $stageData = [
            'name' => 'Test Stage 0101',
            'comment' => 'Test Comment 0101',
            'conference_id' => 1,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0101',
            'comment' => 'Test Comment 0101',
            'conference_id' => 1,
        ]);
    }

    public function test_Stage_Required()
    {
        $stageData = [
            'name' => 'Test Stage 0102',
            'conference_id' => 1,
        ];
    
        $response = $this->postJson('/api/stages', $stageData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0102',
            'comment' => null,
            'conference_id' => 1,
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

    public function test_Stage_Edit_3()
    {
        $stageData = [
            'name' => 'Test Stage 0201',
            'comment' => 'Test Comment',
            'conference_id' => 2,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0201',
            'comment' => 'Test Comment',
            'conference_id' => 2,
        ]);

        $stageId = 3;

        $stageData = [
            'name' => 'Test Stage 0201',
            'comment' => 'Test Comment 2',
            'conference_id' => 2,
        ];

        $response = $this->putJson('/api/stages/' . $stageId, $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(200);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0201',
            'comment' => 'Test Comment 2',
            'conference_id' => 2,
        ]);
    }

    public function test_Stage_Edit_4()
    {
        $stageData = [
            'name' => 'Test Stage 0202',
            'comment' => 'Test Comment',
            'conference_id' => 2,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0202',
            'comment' => 'Test Comment',
            'conference_id' => 2,
        ]);

        $stageId = 4;

        $stageData = [
            'name' => 'Test Stage 0202',
            'comment' => 'Test Comment 3',
            'conference_id' => 2,
        ];

        $response = $this->putJson('/api/stages/' . $stageId, $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(200);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0202',
            'comment' => 'Test Comment 3',
            'conference_id' => 2,
        ]);
    }

    public function test_Stage_Edit_5()
    {
        $stageData = [
            'name' => 'Test Stage 0301',
            'comment' => 'Test Comment',
            'conference_id' => 3,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0301',
            'comment' => 'Test Comment',
            'conference_id' => 3,
        ]);

        $stageId = 5;

        $stageData = [
            'name' => 'Test Stage 0301',
            'comment' => 'Test Comment 4',
            'conference_id' => 3,
        ];

        $response = $this->putJson('/api/stages/' . $stageId, $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(200);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0301',
            'comment' => 'Test Comment 4',
            'conference_id' => 3,
        ]);
    }

    public function test_Stage_Edit_6()
    {
        $stageData = [
            'name' => 'Test Stage 0302',
            'comment' => 'Test Comment',
            'conference_id' => 3,
        ];

        $response = $this->postJson('/api/stages', $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0302',
            'comment' => 'Test Comment',
            'conference_id' => 3,
        ]);

        $stageId = 6;

        $stageData = [
            'name' => 'Test Stage 0302',
            'comment' => 'Test Comment 5',
            'conference_id' => 3,
        ];

        $response = $this->putJson('/api/stages/' . $stageId, $stageData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(200);

        $this->assertDatabaseHas('stages', [
            'name' => 'Test Stage 0302',
            'comment' => 'Test Comment 5',
            'conference_id' => 3,
        ]);
    }

    //////////////////////Stage/////////////////////

    //////////////////////Time_table/////////////////////
    public function test_TimeTable_All()
    {
        $time_tableData = [
            'time_start' => '08:00:00',
            'time_end' => '08:45:00',
            'stage_id' => 1,
            'comment' => 'Test Comment',
        ];

        $response = $this->postJson('/api/time_tables', $time_tableData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('time_tables', [
            'time_start' => '08:00:00',
            'time_end' => '08:45:00',
            'stage_id' => 1,
            'comment' => 'Test Comment',
        ]);
    }

    public function test_TimeTable_Required()
    {
        $time_tableData = [
            'time_start' => '09:00:00',
            'time_end' => '09:45:00',
            'stage_id' => 1,
        ];
    
        $response = $this->postJson('/api/time_tables', $time_tableData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '09:00:00',
            'time_end' => '09:45:00',
            'stage_id' => 1,
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

    public function test_TimeTable_Edit_3()
    {
        $time_tableData = [
            'time_start' => '10:00:00',
            'time_end' => '10:00:00',
            'stage_id' => 2,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '10:00:00',
            'time_end' => '10:00:00',
            'stage_id' => 2,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 3;
        $newTime_tableData = [
            'time_start' => '10:00:00',
            'time_end' => '10:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment 03',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '10:00:00',
            'time_end' => '10:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment 03',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_4()
    {
        $time_tableData = [
            'time_start' => '11:00:00',
            'time_end' => '11:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '11:00:00',
            'time_end' => '11:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 4;
        $newTime_tableData = [
            'time_start' => '11:00:00',
            'time_end' => '11:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment 04',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '11:00:00',
            'time_end' => '11:45:00',
            'stage_id' => 2,
            'comment' => 'Test Comment 04',
        ]);
        $response->assertStatus(200);
    }   
    
    public function test_TimeTable_Edit_5()
    {
        $time_tableData = [
            'time_start' => '12:00:00',
            'time_end' => '12:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '12:00:00',
            'time_end' => '12:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 5;
        $newTime_tableData = [
            'time_start' => '12:00:00',
            'time_end' => '12:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 05',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '12:00:00',
            'time_end' => '12:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 05',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_6()
    {
        $time_tableData = [
            'time_start' => '13:00:00',
            'time_end' => '13:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '13:00:00',
            'time_end' => '13:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 6;
        $newTime_tableData = [
            'time_start' => '13:00:00',
            'time_end' => '13:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 06',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '13:00:00',
            'time_end' => '13:45:00',
            'stage_id' => 3,
            'comment' => 'Test Comment 06',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_7()
    {
        $time_tableData = [
            'time_start' => '14:00:00',
            'time_end' => '14:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '14:00:00',
            'time_end' => '14:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 7;
        $newTime_tableData = [
            'time_start' => '14:00:00',
            'time_end' => '14:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment 07',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '14:00:00',
            'time_end' => '14:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment 07',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_8()
    {
        $time_tableData = [
            'time_start' => '15:00:00',
            'time_end' => '15:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '15:00:00',
            'time_end' => '15:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 8;
        $newTime_tableData = [
            'time_start' => '15:00:00',
            'time_end' => '15:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment 08',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '15:00:00',
            'time_end' => '15:45:00',
            'stage_id' => 4,
            'comment' => 'Test Comment 08',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_9()
    {
        $time_tableData = [
            'time_start' => '16:00:00',
            'time_end' => '16:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '16:00:00',
            'time_end' => '16:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 9;
        $newTime_tableData = [
            'time_start' => '16:00:00',
            'time_end' => '16:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment 09',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '16:00:00',
            'time_end' => '16:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment 09',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_10()
    {
        $time_tableData = [
            'time_start' => '17:00:00',
            'time_end' => '17:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '17:00:00',
            'time_end' => '17:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 10;
        $newTime_tableData = [
            'time_start' => '17:00:00',
            'time_end' => '17:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment 10',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '17:00:00',
            'time_end' => '17:45:00',
            'stage_id' => 5,
            'comment' => 'Test Comment 10',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_11()
    {
        $time_tableData = [
            'time_start' => '18:00:00',
            'time_end' => '18:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '18:00:00',
            'time_end' => '18:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 11;
        $newTime_tableData = [
            'time_start' => '18:00:00',
            'time_end' => '18:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment 11',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '18:00:00',
            'time_end' => '18:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment 11',
        ]);
        $response->assertStatus(200);
    }

    public function test_TimeTable_Edit_12()
    {
        $time_tableData = [
            'time_start' => '19:00:00',
            'time_end' => '19:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment',
        ];
        $response = $this->postJson('/api/time_tables', $time_tableData);
        //$response->dump(); // Print the response to the console
        $response->assertStatus(201);
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '19:00:00',
            'time_end' => '19:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment',
        ]);
        $timeTableId = 12;
        $newTime_tableData = [
            'time_start' => '19:00:00',
            'time_end' => '19:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment 12',
        ];
        $response = $this->putJson('/api/time_tables/' . $timeTableId, $newTime_tableData);
        //$response->dump(); // Print the response to the console
        $this->assertDatabaseHas('time_tables', [
            'time_start' => '19:00:00',
            'time_end' => '19:45:00',
            'stage_id' => 6,
            'comment' => 'Test Comment 12',
        ]);
        $response->assertStatus(200);
    }

    //////////////////////Time_table/////////////////////

    //////////////////////Presentation/////////////////////
    public function test_Presentation_All()
    {
        $presentationData = [
            'name' => 'Test prezentacia',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 20,
            'time_table_id' => 1,
            'comment' => 'Test Comment',
        ];

        $response = $this->postJson('/api/presentations', $presentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia',
            'short_description' => 'Test Short Description',
            'long_description' => 'Test Long Description',
            'max_capacity' => 20,
            'time_table_id' => 1,
            'comment' => 'Test Comment',
        ]);
    }

    public function test_Presentation_Required()
    {
        $presentationData = [
            'name' => 'Test prezentacia 2',
            'max_capacity' => 40,
            'time_table_id' => 2,
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 2',
            'short_description' => null,
            'long_description' => null,
            'max_capacity' => 40,
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

    public function test_Presentation_Edit_3()
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

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name3',
            'short_description' => 'Test Short Description3',
            'long_description' => 'Test Long Description3',
            'max_capacity' => 200,
            'time_table_id' => 2,
            'comment' => 'Test Comment3',
        ]);
    
        $presentationId = 3;

        $newPresentationData = [
            'name' => 'Test prezentacia 3',
            'short_description' => 'Test Short Description 3',
            'long_description' => 'Test Long Description 3',
            'max_capacity' => 60,
            'time_table_id' => 3,
            'comment' => 'Test Comment4',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 3',
            'short_description' => 'Test Short Description 3',
            'long_description' => 'Test Long Description 3',
            'max_capacity' => 60,
            'time_table_id' => 3,
            'comment' => 'Test Comment4',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_4()
    {
        $presentationData = [
            'name' => 'Test Name4',
            'short_description' => 'Test Short Description4',
            'long_description' => 'Test Long Description4',
            'max_capacity' => 300,
            'time_table_id' => 3,
            'comment' => 'Test Comment4',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name4',
            'short_description' => 'Test Short Description4',
            'long_description' => 'Test Long Description4',
            'max_capacity' => 300,
            'time_table_id' => 3,
            'comment' => 'Test Comment4',
        ]);
    
        $presentationId = 4;

        $newPresentationData = [
            'name' => 'Test prezentacia 4',
            'short_description' => 'Test Short Description 4',
            'long_description' => 'Test Long Description 4',
            'max_capacity' => 80,
            'time_table_id' => 4,
            'comment' => 'Test Comment 4',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 4',
            'short_description' => 'Test Short Description 4',
            'long_description' => 'Test Long Description 4',
            'max_capacity' => 80,
            'time_table_id' => 4,
            'comment' => 'Test Comment 4',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_5()
    {
        $presentationData = [
            'name' => 'Test Name5',
            'short_description' => 'Test Short Description5',
            'long_description' => 'Test Long Description5',
            'max_capacity' => 400,
            'time_table_id' => 4,
            'comment' => 'Test Comment5',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name5',
            'short_description' => 'Test Short Description5',
            'long_description' => 'Test Long Description5',
            'max_capacity' => 400,
            'time_table_id' => 4,
            'comment' => 'Test Comment5',
        ]);
    
        $presentationId = 5;

        $newPresentationData = [
            'name' => 'Test prezentacia 5',
            'short_description' => 'Test Short Description 5',
            'long_description' => 'Test Long Description 5',
            'max_capacity' => 100,
            'time_table_id' => 5,
            'comment' => 'Test Comment 5',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 5',
            'short_description' => 'Test Short Description 5',
            'long_description' => 'Test Long Description 5',
            'max_capacity' => 100,
            'time_table_id' => 5,
            'comment' => 'Test Comment 5',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_6()
    {
        $presentationData = [
            'name' => 'Test Name6',
            'short_description' => 'Test Short Description6',
            'long_description' => 'Test Long Description6',
            'max_capacity' => 500,
            'time_table_id' => 5,
            'comment' => 'Test Comment6',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name6',
            'short_description' => 'Test Short Description6',
            'long_description' => 'Test Long Description6',
            'max_capacity' => 500,
            'time_table_id' => 5,
            'comment' => 'Test Comment6',
        ]);
    
        $presentationId = 6;

        $newPresentationData = [
            'name' => 'Test prezentacia 6',
            'short_description' => 'Test Short Description 6',
            'long_description' => 'Test Long Description 6',
            'max_capacity' => 120,
            'time_table_id' => 6,
            'comment' => 'Test Comment 6',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 6',
            'short_description' => 'Test Short Description 6',
            'long_description' => 'Test Long Description 6',
            'max_capacity' => 120,
            'time_table_id' => 6,
            'comment' => 'Test Comment 6',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_7()
    {
        $presentationData = [
            'name' => 'Test Name7',
            'short_description' => 'Test Short Description7',
            'long_description' => 'Test Long Description7',
            'max_capacity' => 600,
            'time_table_id' => 6,
            'comment' => 'Test Comment7',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name7',
            'short_description' => 'Test Short Description7',
            'long_description' => 'Test Long Description7',
            'max_capacity' => 600,
            'time_table_id' => 6,
            'comment' => 'Test Comment7',
        ]);
    
        $presentationId = 7;

        $newPresentationData = [
            'name' => 'Test prezentacia 7',
            'short_description' => 'Test Short Description 7',
            'long_description' => 'Test Long Description 7',
            'max_capacity' => 140,
            'time_table_id' => 7,
            'comment' => 'Test Comment 7',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 7',
            'short_description' => 'Test Short Description 7',
            'long_description' => 'Test Long Description 7',
            'max_capacity' => 140,
            'time_table_id' => 7,
            'comment' => 'Test Comment 7',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_8()
    {
        $presentationData = [
            'name' => 'Test Name8',
            'short_description' => 'Test Short Description8',
            'long_description' => 'Test Long Description8',
            'max_capacity' => 700,
            'time_table_id' => 7,
            'comment' => 'Test Comment8',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name8',
            'short_description' => 'Test Short Description8',
            'long_description' => 'Test Long Description8',
            'max_capacity' => 700,
            'time_table_id' => 7,
            'comment' => 'Test Comment8',
        ]);
    
        $presentationId = 8;

        $newPresentationData = [
            'name' => 'Test prezentacia 8',
            'short_description' => 'Test Short Description 8',
            'long_description' => 'Test Long Description 8',
            'max_capacity' => 160,
            'time_table_id' => 8,
            'comment' => 'Test Comment 8',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 8',
            'short_description' => 'Test Short Description 8',
            'long_description' => 'Test Long Description 8',
            'max_capacity' => 160,
            'time_table_id' => 8,
            'comment' => 'Test Comment 8',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_9()
    {
        $presentationData = [
            'name' => 'Test Name9',
            'short_description' => 'Test Short Description9',
            'long_description' => 'Test Long Description9',
            'max_capacity' => 800,
            'time_table_id' => 8,
            'comment' => 'Test Comment9',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name9',
            'short_description' => 'Test Short Description9',
            'long_description' => 'Test Long Description9',
            'max_capacity' => 800,
            'time_table_id' => 8,
            'comment' => 'Test Comment9',
        ]);
    
        $presentationId = 9;

        $newPresentationData = [
            'name' => 'Test prezentacia 9',
            'short_description' => 'Test Short Description 9',
            'long_description' => 'Test Long Description 9',
            'max_capacity' => 180,
            'time_table_id' => 9,
            'comment' => 'Test Comment 9',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 9',
            'short_description' => 'Test Short Description 9',
            'long_description' => 'Test Long Description 9',
            'max_capacity' => 180,
            'time_table_id' => 9,
            'comment' => 'Test Comment 9',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_10()
    {
        $presentationData = [
            'name' => 'Test Name10',
            'short_description' => 'Test Short Description10',
            'long_description' => 'Test Long Description10',
            'max_capacity' => 900,
            'time_table_id' => 9,
            'comment' => 'Test Comment10',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name10',
            'short_description' => 'Test Short Description10',
            'long_description' => 'Test Long Description10',
            'max_capacity' => 900,
            'time_table_id' => 9,
            'comment' => 'Test Comment10',
        ]);
    
        $presentationId = 10;

        $newPresentationData = [
            'name' => 'Test prezentacia 10',
            'short_description' => 'Test Short Description 10',
            'long_description' => 'Test Long Description 10',
            'max_capacity' => 200,
            'time_table_id' => 10,
            'comment' => 'Test Comment 10',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 10',
            'short_description' => 'Test Short Description 10',
            'long_description' => 'Test Long Description 10',
            'max_capacity' => 200,
            'time_table_id' => 10,
            'comment' => 'Test Comment 10',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_11()
    {
        $presentationData = [
            'name' => 'Test Name11',
            'short_description' => 'Test Short Description11',
            'long_description' => 'Test Long Description11',
            'max_capacity' => 1000,
            'time_table_id' => 10,
            'comment' => 'Test Comment11',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name11',
            'short_description' => 'Test Short Description11',
            'long_description' => 'Test Long Description11',
            'max_capacity' => 1000,
            'time_table_id' => 10,
            'comment' => 'Test Comment11',
        ]);
    
        $presentationId = 11;

        $newPresentationData = [
            'name' => 'Test prezentacia 11',
            'short_description' => 'Test Short Description 11',
            'long_description' => 'Test Long Description 11',
            'max_capacity' => 220,
            'time_table_id' => 11,
            'comment' => 'Test Comment 11',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 11',
            'short_description' => 'Test Short Description 11',
            'long_description' => 'Test Long Description 11',
            'max_capacity' => 220,
            'time_table_id' => 11,
            'comment' => 'Test Comment 11',
        ]);

        $response->assertStatus(200);
    }

    public function test_Presentation_Edit_12()
    {
        $presentationData = [
            'name' => 'Test Name12',
            'short_description' => 'Test Short Description12',
            'long_description' => 'Test Long Description12',
            'max_capacity' => 1100,
            'time_table_id' => 11,
            'comment' => 'Test Comment12',
        ];
    
        $response = $this->postJson('/api/presentations', $presentationData);
    
        //$response->dump(); // Print the response to the console

        $response->assertStatus(201);

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test Name12',
            'short_description' => 'Test Short Description12',
            'long_description' => 'Test Long Description12',
            'max_capacity' => 1100,
            'time_table_id' => 11,
            'comment' => 'Test Comment12',
        ]);
    
        $presentationId = 12;

        $newPresentationData = [
            'name' => 'Test prezentacia 12',
            'short_description' => 'Test Short Description 12',
            'long_description' => 'Test Long Description 12',
            'max_capacity' => 240,
            'time_table_id' => 12,
            'comment' => 'Test Comment 12',
        ];

        $response = $this->putJson('/api/presentations/' . $presentationId, $newPresentationData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('presentations', [
            'name' => 'Test prezentacia 12',
            'short_description' => 'Test Short Description 12',
            'long_description' => 'Test Long Description 12',
            'max_capacity' => 240,
            'time_table_id' => 12,
            'comment' => 'Test Comment 12',
        ]);

        $response->assertStatus(200);
    }
    //////////////////////Presentation/////////////////////

    //////////////////////Sponsor/////////////////////
    public function test_Sponsor_All()
    {
        $sponsorData = [
            'name' => 'Test Sponsor 01',
            'comment' => 'Test Comment',
            'url' => 'https://www.google.com',
            //add photos
            'conference_id' => 1,
        ];

        $response = $this->postJson('/api/sponsors', $sponsorData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 01',
            'comment' => 'Test Comment',
            'url' => 'https://www.google.com',
            'conference_id' => 1,
        ]);
    }

    public function test_Sponsor_Required()
    {
        $sponsorData = [
            'name' => 'Test Sponsor 02',
            'url' => 'https://www.duckduckgo.com',
            'conference_id' => 1,
        ];

        $response = $this->postJson('/api/sponsors', $sponsorData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 02',
            'comment' => null,
            'url' => 'https://www.duckduckgo.com',
            'conference_id' => 1,
        ]);
    }

    public function test_Sponsor_Edit_1(){
        $sponsorData = [
            'name' => 'Test Sponsor 02',
            'comment' => 'Test Comment 02',
            'url' => 'https://www..com',
            'conference_id' => 2,
        ];

        $response = $this->postJson('/api/sponsors', $sponsorData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 02',
            'comment' => 'Test Comment 02',
            'url' => 'https://www..com',
            'conference_id' => 2,
        ]);

        $sponsorId = 3;

        $newSponsorData = [
            'name' => 'Test Sponsor 03',
            'comment' => 'Test Comment 03',
            'url' => 'https://www.facebbook.com',
            'conference_id' => 2,
        ];

        $response = $this->putJson('/api/sponsors/' . $sponsorId, $newSponsorData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 03',
            'comment' => 'Test Comment 03',
            'url' => 'https://www.facebbook.com',
            'conference_id' => 2,
        ]);

        $response->assertStatus(200);
    }

    public function test_sponsor_Edit_2(){
        $sponsorData = [
            'name' => 'Test Sponsor 03',
            'comment' => 'Test Comment 03',
            'url' => 'https://www..com',
            'conference_id' => 2,
        ];

        $response = $this->postJson('/api/sponsors', $sponsorData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 03',
            'comment' => 'Test Comment 03',
            'url' => 'https://www..com',
            'conference_id' => 2,
        ]);

        $sponsorId = 4;

        $newSponsorData = [
            'name' => 'Test Sponsor 04',
            'comment' => 'Test Comment 04',
            'url' => 'https://www.twitter.com',
            'conference_id' => 3,
        ];

        $response = $this->putJson('/api/sponsors/' . $sponsorId, $newSponsorData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 04',
            'comment' => 'Test Comment 04',
            'url' => 'https://www.twitter.com',
            'conference_id' => 3,
        ]);

        $response->assertStatus(200);
    }

    public function test_sponsor_Edit_3(){
        $sponsorData = [
            'name' => 'Test Sponsor 04',
            'comment' => 'Test Comment 04',
            'url' => 'https://www..com',
            'conference_id' => 3,
        ];

        $response = $this->postJson('/api/sponsors', $sponsorData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 04',
            'comment' => 'Test Comment 04',
            'url' => 'https://www..com',
            'conference_id' => 3,
        ]);

        $sponsorId = 5;

        $newSponsorData = [
            'name' => 'Test Sponsor 05',
            'comment' => 'Test Comment 05',
            'url' => 'https://www.instagram.com',
            'conference_id' => 3,
        ];

        $response = $this->putJson('/api/sponsors/' . $sponsorId, $newSponsorData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 05',
            'comment' => 'Test Comment 05',
            'url' => 'https://www.instagram.com',
            'conference_id' => 3,
        ]);

        $response->assertStatus(200);
    }

    public function test_Sponsor_Edit_4()
    {
        $responseData = [
            'name' => 'Test Sponsor 01',
            'comment' => 'Test Comment 01',
            'url' => 'https://www.instagram.com',
            'conference_id' => 1,
        ];

        $response = $this->postJson('/api/sponsors', $responseData);

        $response->assertStatus(201);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 01',
            'comment' => 'Test Comment 01',
            'url' => 'https://www.instagram.com',
            'conference_id' => 1,
        ]);

        $sponsorId = 6;

        $newSponsorData = [
            'name' => 'Test Sponsor 06',
            'comment' => 'Test Comment 06',
            'url' => 'https://www.instagram.com',
            'conference_id' => 2,
        ];

        $response = $this->putJson('/api/sponsors/' . $sponsorId, $newSponsorData);

        //$response->dump(); // Print the response to the console

        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor 06',
            'comment' => 'Test Comment 06',
            'url' => 'https://www.instagram.com',
            'conference_id' => 2,
        ]);
    }

    public function test_Sponsor_NoConferenceId()
    {
        $sponsorData = [
            'name' => 'Test Sponsor 05',
            'comment' => 'Test Comment 05',
            'url' => 'https://www.instagram.com',
        ];
    
        $response = $this->postJson('/api/sponsors', $sponsorData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('conference_id');
    }

    public function test_Sponsor_NoName()
    {
        $sponsorData = [
            'comment' => 'Test Comment 06',
            'url' => 'https://www.instagram.com',
            'conference_id' => 1,
        ];
    
        $response = $this->postJson('/api/sponsors', $sponsorData);
    
        //$response->dump(); // Print the response to the console
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }
    
    
    //////////////////////Sponsor/////////////////////
}