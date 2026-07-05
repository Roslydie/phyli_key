<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(Users::latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = Users::create($validated);

        return response()->json($user->makeHidden(['password']), 201);
    }

    public function show(Users $user)
    {
        return response()->json($user->makeHidden(['password']));
    }

    public function update(Request $request, Users $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user->update($validated);

        return response()->json($user->fresh()->makeHidden(['password']));
    }

    public function destroy(Users $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }
}
