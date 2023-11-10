<?php

namespace App\Http\Controllers;

use App\Http\Requests\PCParts\DeletePCPartRequest;
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
        $userProfile = UserProfile::findOrFail($request->profile_id);
        
        $parts = UserProfilePCPart::query()
            ->where('profile_id', $userProfile->id)
            ->whereIn('id', $parts->pluck('id'))
            ->get()
            ->each(function($part) use ($parts) {
                $partName = $parts->where('id', $part->id)->first()['name'];

                if ($partName != $part->name) {
                    $part->update([
                        'name' => $partName
                    ]);
                }
            });
        
        return response()->json([
            'message' => 'Part successfully updated.',
            'parts' => $parts
        ], 200);
    }

    public function delete(DeletePCPartRequest $request) : JsonResponse {
        UserProfilePCPart::query()
            ->where('id', $request->id)
            ->where('profile_id', $request->profile_id)
            ->delete();

        return response()->json([
            'message' => 'Part successfully deleted.',
            'parts' => UserProfile::find($request->profile_id)->pcParts
        ], 200);
    }

}
