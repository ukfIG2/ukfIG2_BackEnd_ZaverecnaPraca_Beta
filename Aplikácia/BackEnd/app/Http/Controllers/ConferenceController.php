<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Conference::all();
    }

    public function create()
    {
        //Using Vue3.
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'comment' => 'nullable',
            'address' => 'nullable',
        ]);

        $conference = new Conference([
            'name' => $request->get('name'),
            'date' => $request->get('date'),
            'state' => 'preparing',
            'comment' => $request->get('comment'),
            'address_of_conference' => $request->get('address'),
        ]);

        $conference->save();

        //return response()->json('Conference Created Successfully.');
        return response()->json(['message' => 'Conference Created Successfully.'], 201);

    }
    
    public function show($id)
    {
        // Find the conference by its ID
        $conference = Conference::find($id);

        // If the conference was not found, return a 404 error
        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        // Return the conference data
        return response()->json($conference);
    }
    
    public function edit(Conference $conference)
    {
        //Using Vue3.
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'date' => 'required|date',
            'state' => 'required|string',
            'comment' => 'nullable|string',
            'address_of_conference' => 'nullable|string',
        ]);

        // Find the conference by its ID
        $conference = Conference::find($id);

        // If the conference was not found, return a 404 error
        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        // Update the conference with the request data
        $conference->update($request->all());

        // Return the updated conference
        return response()->json($conference);
    }
    
    public function destroy($id)
    {
        // Find the conference by its ID
        $conference = Conference::find($id);

        // If the conference was not found, return a 404 error
        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        // Delete the conference
        $conference->delete();

        // Return a success message
        return response()->json(['message' => 'Conference deleted successfully']);
    }
}
