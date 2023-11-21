<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    /**
     * Track a visit for the unique external ID. This is idempotent
     *
     * @param  string  $externalId
     * @return \Illuminate\Http\Response
     */
    public function trackVisit($externalId)
    {
        // Check if the visit with the external ID already exists
        $visit = Visit::where('external_id', $externalId)->first();

        // If the visit doesn't exist, create a new one
        if (!$visit) {
            $visit = Visit::create([
                'external_id' => $externalId,
            ]);
        }

        // return a success response without body
        return response()->noContent(200);
    }

    /**
     * Update the stage of interaction for the given external ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStage(UpdateStageRequest $request)
    {
        // Find the visit with the external ID
        $visit = Visit::where('external_id', $request->externalId)->first();

        // If the visit doesn't exist, return not found without body
        if (!$visit) {
            return response()->noContent(404);
        }

        $visit->update([
            'stage' => $request->stage,
        ]);

        // return a success response without body
        return response()->noContent(200);
    }
}
