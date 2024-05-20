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
            'state' => 'prepearing',
            'comment' => $request->get('comment'),
            'address_of_conference' => $request->get('address'),
        ]);

        $conference->save();

        return response()->json('Conference Created Successfully.');
    }


    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conference $conference)
    {
        //Using Vue3.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conference $conference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conference $conference)
    {
        //
    }
}
