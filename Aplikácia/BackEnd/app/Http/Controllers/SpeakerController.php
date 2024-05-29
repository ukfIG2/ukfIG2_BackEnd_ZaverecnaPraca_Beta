<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\First_name;
use App\Models\Middle_name;
use App\Models\Last_name;
use App\Models\Company;
use App\Models\Position;

class SpeakerController extends Controller
{

    public function index()
    {
        return Speaker::with('title', 'first_name', 'middle_name', 'last_name', 'company', 'position')->get()->map(function ($speaker) {
            return [
                'id' => $speaker->id,
                'title_id' => $speaker->title_id,
                'title' => $speaker->title ? $speaker->title->title : null,

                'first_name_id' => $speaker->first_name_id,
                'first_name' => $speaker->first_name ? $speaker->first_name->first_name : null,

                'middle_name_id' => $speaker->middle_name_id,
                'middle_name' => $speaker->middle_name ? $speaker->middle_name->middle_name : null,

                'last_name_id' => $speaker->last_name_id,
                'last_name' => $speaker->last_name ? $speaker->last_name->last_name : null,

                'company_id' => $speaker->company_id,
                'company' => $speaker->company ? $speaker->company->company_name : null,

                'position_id' => $speaker->position_id,
                'position' => $speaker->position ? $speaker->position->position_name : null,

                'short_description' => $speaker->short_description,
                'long_description' => $speaker->long_description,
                'comment' => $speaker->comment,
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
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'comment' => 'nullable|string',
        ]);

        $title = !empty($validatedData['title']) ? Title::firstOrCreate(['title' => $validatedData['title']]) : null;
        $firstName = !empty($validatedData['first_name']) ? First_name::firstOrCreate(['first_name' => $validatedData['first_name']]) : null;
        $middleName = !empty($validatedData['middle_name']) ? Middle_name::firstOrCreate(['middle_name' => $validatedData['middle_name']]) : null;
        $lastName = !empty($validatedData['last_name']) ? Last_name::firstOrCreate(['last_name' => $validatedData['last_name']]) : null;
        $company = !empty($validatedData['company']) ? Company::firstOrCreate(['company_name' => $validatedData['company']]) : null;
        $position = !empty($validatedData['position']) ? Position::firstOrCreate(['position_name' => $validatedData['position']]) : null;

        $speaker = Speaker::create([
            'title_id' => $title ? $title->id : null,
            'first_name_id' => $firstName ? $firstName->id : null,
            'middle_name_id' => $middleName ? $middleName->id : null,
            'last_name_id' => $lastName ? $lastName->id : null,
            'company_id' => $company ? $company->id : null,
            'position_id' => $position ? $position->id : null,
            'short_description' => $validatedData['short_description'] ?? null,
            'long_description' => $validatedData['long_description'] ?? null,
            'comment' => $validatedData['comment'] ?? null,
        ]);

        return response()->json($speaker, 201);
    }

    public function show($id)
    {
        return Speaker::with('title', 'first_name', 'middle_name', 'last_name', 'company', 'position')->where('id', $id)->get()->map(function ($speaker) {
            return [
                'id' => $speaker->id,
                'title_id' => $speaker->title_id,
                'title' => $speaker->title ? $speaker->title->title : null,

                'first_name_id' => $speaker->first_name_id,
                'first_name' => $speaker->first_name ? $speaker->first_name->first_name : null,

                'middle_name_id' => $speaker->middle_name_id,
                'middle_name' => $speaker->middle_name ? $speaker->middle_name->middle_name : null,

                'last_name_id' => $speaker->last_name_id,
                'last_name' => $speaker->last_name ? $speaker->last_name->last_name : null,

                'company_id' => $speaker->company_id,
                'company' => $speaker->company ? $speaker->company->company_name : null,

                'position_id' => $speaker->position_id,
                'position' => $speaker->position ? $speaker->position->position_name : null,

                'short_description' => $speaker->short_description,
                'long_description' => $speaker->long_description,
                'comment' => $speaker->comment,
            ];
        })->first();
        //});
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
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'comment' => 'nullable|string',
        ]);

        $title = !empty($validatedData['title']) ? Title::firstOrCreate(['title' => $validatedData['title']]) : null;
        $firstName = !empty($validatedData['first_name']) ? First_name::firstOrCreate(['first_name' => $validatedData['first_name']]) : null;
        $middleName = !empty($validatedData['middle_name']) ? Middle_name::firstOrCreate(['middle_name' => $validatedData['middle_name']]) : null;
        $lastName = !empty($validatedData['last_name']) ? Last_name::firstOrCreate(['last_name' => $validatedData['last_name']]) : null;
        $company = !empty($validatedData['company']) ? Company::firstOrCreate(['company_name' => $validatedData['company']]) : null;
        $position = !empty($validatedData['position']) ? Position::firstOrCreate(['position_name' => $validatedData['position']]) : null;

        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        $speaker->title_id = $title ? $title->id : null;
        $speaker->first_name_id = $firstName ? $firstName->id : null;
        $speaker->middle_name_id = $middleName ? $middleName->id : null;
        $speaker->last_name_id = $lastName ? $lastName->id : null;
        $speaker->company_id = $company ? $company->id : null;
        $speaker->position_id = $position ? $position->id : null;
        $speaker->short_description = $validatedData['short_description'] ?? null;
        $speaker->long_description = $validatedData['long_description'] ?? null;
        $speaker->comment = $validatedData['comment'] ?? null;

        $speaker->save();

        return response()->json(['message' => 'Speaker Updated Successfully.'], 200);

    }

    public function destroy($id)
    {
        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        $speaker->delete();

        return response()->json(['message' => 'Speaker Deleted Successfully.'], 200);
    }
}
