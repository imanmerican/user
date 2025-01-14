<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;

class UserController extends Controller
{
    //
    public function index()
    {
       
        $users = User::all();

        
        return view('welcome', compact('users'));
    }

    // Store a new user (POST /users)
    public function store(Request $request) {

        $validator = FacadesValidator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required|string',
            'address' => 'required|string',
            'race' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 422);
        } else {

            $user = User::create([
                'firstname' => $request->name,
                'secondname' => $request->username,
                'email' => $request->email,
                'gender' =>  $request->password,
                'address' => $request->role,
                'race' => $request->status,
            ]);

            if($user) {
                return response()->json([
                    'message' => 'User created successfully',
                    'user' => $user
                ], 200);
            } else {
                return response()->json(['message' => 'Something went wrong.'], 500);
            }   
        }
        
    }
}
