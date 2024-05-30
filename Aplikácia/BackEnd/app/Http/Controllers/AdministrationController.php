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
 /*   public function index()
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

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'confirmed_password' => 'required|same:password', // 'confirmed_password' => 'required|same:password
            'comment' => 'nullable',
        ]);

        $administration = new Administration([
            'login' => $request->get('login'),
            'password' => $request->get('confirmed_password'),
            'comment' => $request->get('comment'),
        ]);

        $administration->save();

        return response()->json(['message' => 'Administration Created Successfully.'], 201);
    }

    public function show($id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administration not found'], 404);
        }

        return[
            'id' => $administration->id,
            'login' => $administration->login,
            'comment' => $administration->comment,
            //in case if needed timesamps
            'created_at' => $administration->created_at,
            'updated_at' => $administration->updated_at,
        ];
    }

    public function updateComment(Request $request, $id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administratot not found'], 404);
        }

        $request->validate([
            'comment' => 'nullable',
        ]);

        $administration->comment = $request->get('comment');

        $administration->save();

        return response()->json(['message' => 'Administration comment Updated Successfully.'], 200);
    }

    public function updateLogin(Request $request, $id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administratot not found'], 404);
        }

        $request->validate([
            'login' => 'required',
        ]);

        $administration->login = $request->get('login');

        $administration->save();

        return response()->json(['message' => 'Administration login Updated Successfully.'], 200);
    }

    public function updatePassword(Request $request, $id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administratot not found'], 404);
        }

        $request->validate([
            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ]);

        $administration->password = $request->get('confirmed_password');

        $administration->save();

        return response()->json(['message' => 'Administration password Updated Successfully.'], 200);
    }

    public function destroy($Request $request, $id)
    {
        $administration = Administration::find($id);

        if (!$administration) {
            return response()->json(['message' => 'Administration not found'], 404);
        }

        

        $administration->delete();

        return response()->json(['message' => 'Administration Deleted Successfully.']);
    }*/

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


}
