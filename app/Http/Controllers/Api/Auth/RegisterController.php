<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\SendOtpMail;
use App\Models\UserPhoto;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'phone_number.unique' => 'The phone number is already registered. Please use a different phone number.',
            'phone_number.digits' => 'The phone number must be exactly 10 digits.',
            'password.min' => 'Your password must have at least 8 characters.',
            'email.unique' => 'The email address is already taken.',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'location' => $validated['location'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $defaultAvatar = UserPhoto::find(11); 

        if ($defaultAvatar) {
            $user->profile_photo = $defaultAvatar->photo_url;
        }
        
        $otp = rand(100000, 999999);
        $hashedOtp = bcrypt($otp);
        $otpExpiry = Carbon::now()->addMinutes(10);
        
        $user->otp = $hashedOtp;
        $user->otp_expiry = $otpExpiry;
        $user->save();


        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'message' => 'User created successfully. Please verify your email.',
            'email' => $user->email,
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->otp_expiry < Carbon::now()) {
            return response()->json(['error' => 'OTP expired. Please request a new one.'], 400);
        }

        // Verify OTP
        if (!Hash::check($validated['otp'], $user->otp)) {
            return response()->json(['error' => 'Invalid OTP'], 400);
        }

        $user->is_verified = true;
        $user->otp = null;
        $user->otp_expiry = null;
        $user->save();

        $token = $user->createToken('otp-lar')->plainTextToken;

        return response()->json(['message' => 'Email verified successfully.', 'token' => $token]);
    }
}
