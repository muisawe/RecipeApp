<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserRecourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {

        $validated = $request->validated();


        User::creating(function ($user) {
            $user->password = bcrypt($user->password);
        });



        $user = User::create($validated);


        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserRecourse($user),
            'token' => $user->createToken('MyApp')->plainTextToken,
        ], 201);
    }


    public function login(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);



        $user = User::where('phone_number', $validated['phone_number'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Password is incorrect',
            ], 401);
        }




        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserRecourse($user),
            'token' => $user->createToken('MyApp')->plainTextToken,
        ], 200);
    }
}
