<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministrationController extends Controller
{
    public function index()
    {
        return Administration::all()->map(function ($administration) {
            return [
                'id' => $administration->id,
                'login' => $administration->login,
                'comment' => $administration->comment,
                //in case if needed timesamps
                'created_at' => $administration->created_at,
                'updated_at' => $administration->updated_at,
            ];
        });
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['confirmed_password']);
        $administration = Administration::create($input);
        //$success['token'] = $administration->createToken('MyApp')->plainTextToken;
        //$success['login'] = $administration->login;

        //return response()->json(['Successfull registration' => $success], 200);

        return response()->json(['message' => 'Administrator created Successfully.'], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        $admin = Administration::where('login', $request->login)->first();

        if (!$admin && Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $admin->createToken('MyApp')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => 'admin',
    ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
/*
    public function logout(){
        if (auth()->check()) {
            auth()->user()->tokens()->delete();
            return response(['message' => 'Logged out']);
        }

        return response(['message' => 'No authenticated user'], 401);
    }*/

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $admin = Administration::where('id', $request->id)->first();

        if (!$admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $admin->password = Hash::make($request->confirmed_password);
        $admin->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function destroy($id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administration not found'], 404);
        }

        $administration->delete();

        return response()->json(['message' => 'Administration deleted successfully']);
    }

    public function changeComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $admin = Administration::where('id', $request->id)->first();

        if (!$admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $admin->comment = $request->comment;
        $admin->save();

        return response()->json(['message' => 'Comment changed successfully'], 200);
    }


}
