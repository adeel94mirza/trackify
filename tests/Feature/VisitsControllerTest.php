<?php

namespace Tests\Feature;

use App\Models\Visit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VisitsControllerTest extends TestCase
{
    use RefreshDatabase; // This trait resets the database after each test case

    public function testTrackVisit()
    {
        // create new user
        $user = \App\Models\User::factory()->create();

        // create new api token for the user
        $token = $user->createToken('test-token')->plainTextToken;

        // Generate a unique external ID for testing
        $externalId = 'test_external_id';

        // Make a request to track a visit with the generated external ID
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get("/api/v1/track-visit/{$externalId}");

        // Assert that the response has a successful status code
        $response->assertNoContent(200);

        // Assert that the visit with the external ID exists in the database
        $this->assertDatabaseHas('visits', ['external_id' => $externalId]);
    }

    public function testIdempotentTrackVisit()
    {
        // create new user
        $user = \App\Models\User::factory()->create();

        // create new api token for the user
        $token = $user->createToken('test-token')->plainTextToken;

        // Generate a unique external ID for testing
        $externalId = 'test_external_id';

        // Make a request to track a visit with the generated external ID
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get("/api/v1/track-visit/{$externalId}");

        // Assert that the response has a successful status code
        $response->assertNoContent(200);

        // Assert that the visit with the external ID exists in the database
        $this->assertDatabaseHas('visits', ['external_id' => $externalId]);

        // Make the same request again to track the visit with the same external ID
        $responseDuplicate = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get("/api/v1/track-visit/{$externalId}");

        // Assert that the response for the duplicate request also has a successful status code
        $responseDuplicate->assertNoContent(200);

        // Assert that the visit with the external ID still exists only once in the database
        $this->assertCount(1, Visit::where('external_id', $externalId)->get());
    }

    public function testUpdateStage()
    {
        // create new user
        $user = \App\Models\User::factory()->create();

        // create new api token for the user
        $token = $user->createToken('test-token')->plainTextToken;

        // Create a visit in the database for testing
        $visit = Visit::factory()->create();

        // Make a request to update the stage of the visit
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->patch("/api/v1/update-stage", [
                'externalId' => $visit->external_id,
                'stage' => 'visited',
            ]);

        // Assert that the response has a successful status code
        $response->assertNoContent(200);

        // Reload the visit from the database to get the updated values
        $visit->refresh();

        // Assert that the stage of the visit has been updated
        $this->assertEquals('visited', $visit->stage);
    }

    public function testUpdateStageWithInvalidStage()
    {
        // create new user
        $user = \App\Models\User::factory()->create();

        // create new api token for the user
        $token = $user->createToken('test-token')->plainTextToken;

        // Create a visit in the database for testing
        $visit = Visit::factory()->create();

        // Make a request to update the stage with a invalid stage
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->patch("/api/v1/update-stage", [
                'externalId' => $visit->external_id,
                'stage' => 'invalid_stage',
            ]);

        // Assert that the response has a validation errors
        $response->assertUnprocessable();
    }

    public function testUpdateStageWithNonExistingVisit()
    {
        // create new user
        $user = \App\Models\User::factory()->create();

        // create new api token for the user
        $token = $user->createToken('test-token')->plainTextToken;

        // Make a request to update the stage with a non-existing external ID
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->patch("/api/v1/update-stage", [
                'externalId' => 'non_existing_external_id',
                'stage' => 'visited',
            ]);

        // Assert that the response has a not found status code
        $response->assertNoContent(404);
    }
}
