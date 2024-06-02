<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Title;
use App\Models\First_name;
use App\Models\Middle_name;
use App\Models\Last_name;
use App\Models\Company;
use App\Models\Position;
use App\Models\Email;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        //
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'first_name' => 'required|string:255',
            'middle_name' => 'nullable|string:255',
            'last_name' => 'required|string:255',
            'company' => 'nullable|string:255',
            'position' => 'nullable|string:255',
            'email' => 'required|email:255',
            //'token_link' => 'required|string:255', //password

            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $title = $request->title ? Title::firstOrCreate(['title' => $request->title]) : null;
        $firstName = First_name::firstOrCreate(['first_name' => $request->first_name]);
        $middleName = $request->middle_name ? Middle_name::firstOrCreate(['middle_name' => $request->middle_name]) : null;
        $lastName = Last_name::firstOrCreate(['last_name' => $request->last_name]);
        $company = $request->company ? Company::firstOrCreate(['company_name' => $request->company]) : null;
        $position = $request->position ? Position::firstOrCreate(['position_name' => $request->position]) : null;
        $email = Email::firstOrCreate(['email' => $request->email]);

        $token_link = Hash::make($request->confirmed_password);

/*
        $input = $request->all();
        $input['token_link'] = Hash::make($input['token_link']);
        $participant = Participant::create($input);*/

        $participant = Participant::create([
            'title_id' => $title ? $title->id : null,
            'first_name_id' => $firstName->id,
            'middle_name_id' => $middleName ? $middleName->id : null,
            'last_name_id' => $lastName->id,
            'company_id' => $company ? $company->id : null,
            'position_id' => $position ? $position->id : null,
            'email_id' => $email->id,
            //'token_link' => Hash::make($request->token_link),
            'token_link' => $token_link,
        ]);

        return response()->json(['message' => 'Participant created Successfully.'], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:255',
            'token_link' => 'required|string:255',
        ]);

        //$participant = Participant::where('email', $request->email)->first();

        $participant = Participant::whereHas('email', function ($query) use ($request) {
            $query->where('email', $request->email);
        })->first();

        if (!$participant && Hash::check($request->token_link, $participant->token_link)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $participant->createToken('MyApp')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => 'participant',
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
