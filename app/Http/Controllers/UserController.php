<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers(){
        return response()->json(User::all(), 200);
    }

    public function createUser(Request $request){
        // Validation. If rules are broken return error message.
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        // If the input is valid, create the user and return that user with a confirmation.
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ]);
        return response($user, 201);
    }

    public function updateUser(Request $request, $id){
        $request->validate([
            'no_fields_to_update' => 'required_without_all:first_name,last_name,email',
            'email' => 'email|unique:users'
        ],[
            'required_without_all' => 'You must have at least one valid field to update user.'
        ]);
        $user = User::find($id);
        if(is_null($user)){
            return response()->json('User not found', 404);
        }
        $user->update($request->all());
        return response($user, 200);
    }
}
