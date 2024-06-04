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
        return Participant::with('title', 'first_name', 'middle_name', 'last_name', 'company', 'position', 'email')->get()->map(function ($participant) {
            return [
                'id' => $participant->id,
                'title_id' => $participant->title_id,
                'title' => $participant->title ? $participant->title->title : null,

                'first_name_id' => $participant->first_name_id,
                'first_name' => $participant->first_name ? $participant->first_name->first_name : null,

                'middle_name_id' => $participant->middle_name_id,
                'middle_name' => $participant->middle_name ? $participant->middle_name->middle_name : null,

                'last_name_id' => $participant->last_name_id,
                'last_name' => $participant->last_name ? $participant->last_name->last_name : null,

                'company_id' => $participant->company_id,
                'company' => $participant->company ? $participant->company->company_name : null,

                'position_id' => $participant->position_id,
                'position' => $participant->position ? $participant->position->position_name : null,

                'email_id' => $participant->email_id,
                'email' => $participant->email ? $participant->email->email : null,

                'comment' => $participant->comment,
            ];
        });
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'nullable|string',
        ]);

        $title = $request->title ? Title::firstOrCreate(['title' => $request->title]) : null;
        $firstName = First_name::firstOrCreate(['first_name' => $request->first_name]);
        $middleName = $request->middle_name ? Middle_name::firstOrCreate(['middle_name' => $request->middle_name]) : null;
        $lastName = Last_name::firstOrCreate(['last_name' => $request->last_name]);
        $company = $request->company ? Company::firstOrCreate(['company_name' => $request->company]) : null;
        $position = $request->position ? Position::firstOrCreate(['position_name' => $request->position]) : null;
        $email = Email::firstOrCreate(['email' => $request->email]);

        $participant = Participant::create([
            'title_id' => $title ? $title->id : null,
            'first_name_id' => $firstName->id,
            'middle_name_id' => $middleName ? $middleName->id : null,
            'last_name_id' => $lastName->id,
            'company_id' => $company ? $company->id : null,
            'position_id' => $position ? $position->id : null,
            'email_id' => $email->id,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Participant created Successfully.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Participant::with('title', 'first_name', 'middle_name', 'last_name', 'company', 'position', 'email')->find($id)->map(function ($participant) {
            return [
                'id' => $participant->id,
                'title_id' => $participant->title_id,
                'title' => $participant->title ? $participant->title->title : null,

                'first_name_id' => $participant->first_name_id,
                'first_name' => $participant->first_name ? $participant->first_name->first_name : null,

                'middle_name_id' => $participant->middle_name_id,
                'middle_name' => $participant->middle_name ? $participant->middle_name->middle_name : null,

                'last_name_id' => $participant->last_name_id,
                'last_name' => $participant->last_name ? $participant->last_name->last_name : null,

                'company_id' => $participant->company_id,
                'company' => $participant->company ? $participant->company->company_name : null,

                'position_id' => $participant->position_id,
                'position' => $participant->position ? $participant->position->position_name : null,

                'email_id' => $participant->email_id,
                'email' => $participant->email ? $participant->email->email : null,

                'comment' => $participant->comment,
            ];
        });
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'nullable|string',
        ]);

        $title = $request->title ? Title::firstOrCreate(['title' => $request->title]) : null;
        $firstName = First_name::firstOrCreate(['first_name' => $request->first_name]);
        $middleName = $request->middle_name ? Middle_name::firstOrCreate(['middle_name' => $request->middle_name]) : null;
        $lastName = Last_name::firstOrCreate(['last_name' => $request->last_name]);
        $company = $request->company ? Company::firstOrCreate(['company_name' => $request->company]) : null;
        $position = $request->position ? Position::firstOrCreate(['position_name' => $request->position]) : null;
        $email = Email::firstOrCreate(['email' => $request->email]);

        $participant = Participant::find($id);

        $participant->update([
            'title_id' => $title ? $title->id : null,
            'first_name_id' => $firstName->id,
            'middle_name_id' => $middleName ? $middleName->id : null,
            'last_name_id' => $lastName->id,
            'company_id' => $company ? $company->id : null,
            'position_id' => $position ? $position->id : null,
            'email_id' => $email->id,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Participant updated Successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();

        return response()->json(['message' => 'Participant deleted Successfully.'], 200);
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
