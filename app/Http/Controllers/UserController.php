<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
            ]);
    
            return User::create($validatedData);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function show(string $id)
    {
        $user = User::with('cards')->findOrFail($id);
        return response()->json($user);
    }


    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id); 

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
             ]);
     
             $user->name = $request->input('name');
             $user->email = $request->input('email');
             $user->save();
     
             return User::findorfail($id);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'user não encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'user deletado com sucesso']);
    }
}
