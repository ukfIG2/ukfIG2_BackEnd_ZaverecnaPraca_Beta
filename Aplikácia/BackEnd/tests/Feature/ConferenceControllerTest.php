<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Test\Controller\Conference_all;
use Test\Controller\Conference_required;

class ConferenceControllerTest extends TestCase
{
    public function testAll()
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

    public function testrequired()
    {
        $conferenceData = [
            'name' => 'Test Conference 02',
            'date' => '2022-12-31',
        ];
    
        $response = $this->postJson('/api/conferences', $conferenceData);
    
        //$response->dump(); // Print the response to the console
    
        $this->assertDatabaseHas('conferences', [
            'name' => 'Test Conference 02',
            'date' => '2022-12-31',
            'state' => 'preparing',
            'comment' => null,
            'address_of_conference' => null,
        ]);
    }

    public function testNoname()
    {
        $conferenceData = [
            'date' => '2022-12-31',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function testNodate()
    {
        $conferenceData = [
            'name' => 'Test Conference 03',
        ];

        $response = $this->postJson('/api/conferences', $conferenceData);

        //$response->dump(); // Print the response to the console

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('date');
    }

    public function testNoNothing()
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
    
    public function testComment()
{
        // Get the ID of the created conference
    $conferenceId = 2;

    // Define the new data
    $newData = [
        'name' => 'Test Conference 02',
        'date' => '2022-12-31',
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

public function testAdress()
{
    // Define the initial data
    $initialData = [
        'name' => 'Test Conference 3',
        'date' => '2022-12-31',
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
        'date' => '2022-12-31',
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

    


}
