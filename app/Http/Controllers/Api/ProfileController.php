<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function getProfile(Request $request)
    {
        $user = auth('sanctum')->user();

        return new ProfileResource($user);
    }

    public function getProfilePhotos()
    {

        $photos = UserPhoto::all();

        return response()->json([
            'photos' => $photos->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'photo_url' => asset($photo->photo_url),
                ];
            })
        ]);
    }

    public function updateProfilePhoto(Request $request)
    {
        // Validate the input
        $request->validate([
            'photo_id' => 'required|integer|exists:user_photos,id',
        ]);


        $user = $request->user();


        $photo = UserPhoto::findOrFail($request->photo_id);

        $user->profile_photo = $photo->photo_url;
        $user->save();


        return new ProfileResource($user);
    }
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json(['message' => 'The current password is incorrect.'], 400);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }


    public function updateFirstName(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
        ]);

        $user = $request->user();

        $user->first_name = $validated['first_name'];

        $user->save();

        return response()->json(['message' => 'First name updated successfully.']);
    }

    public function updateLastName(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
        ]);

        $user = $request->user();

        $user->last_name = $validated['last_name'];

        $user->save();

        return response()->json(['message' => 'Last name updated successfully.']);
    }
    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . auth('sanctum')->id(),
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401);  // Unauthorized
        }

        $user->email = $validated['email'];

        $user->save();

        return response()->json(['message' => 'Email updated successfully.']);
    }

    public function updatePhoneNumber(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|digits:10|unique:users,phone_number,' . auth('sanctum')->id(),
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }

        $user->phone_number = $validated['phone_number'];

        $user->save();

        return response()->json(['message' => 'Phone number updated successfully.']);
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'location' => 'nullable|string|max:255',
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }

        $user->location = $validated['location'];

        $user->save();

        return response()->json(['message' => 'Location updated successfully.']);
    }
}
