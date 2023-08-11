<?php

namespace App\Http\Controllers;

use App\Http\Requests\PCParts\StorePCPartRequest;
use App\Http\Requests\PCParts\UpdatePCPartRequest;
use App\Models\UserProfile;
use App\Models\UserProfilePCPart;
use Illuminate\Http\JsonResponse;

class PCPartsController extends Controller {
    public function store(StorePCPartRequest $request) : JsonResponse {
        UserProfilePCPart::create($request->validated());

        return response()->json([
            'parts' => UserProfile::find($request->profile_id)->pcParts,
            'message' => 'Part successfully added.'
        ]);
    }

    public function update(UpdatePCPartRequest $request) : JsonResponse {
        $parts = collect($request->parts);

        UserProfilePCPart::query()
            ->where('profile_id', UserProfile::findOrFail($request->profile_id))
            ->whereIn('id', $parts->pluck('id'))
            ->get()
            ->each(fn($part) => $part->update([
                'name' => $parts->where('id', $part->id)->first()['name']
            ]));
        
        return response()->json([
            'parts' => $this->userProfile->pcParts
        ], 200);
    }

}
