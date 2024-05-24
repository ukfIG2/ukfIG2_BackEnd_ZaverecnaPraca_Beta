<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stage::with('conference')->get()->map(function ($stage) {
            return [
                'id' => $stage->id,
                'conference_id' => $stage->conference_id,
                'name' => $stage->name,
                'comment' => $stage->comment,
                'conference' => $stage->conference->name,
                //in case if needed timesamps
                'created_at' => $stage->created_at,
                'updated_at' => $stage->updated_at,
            ];
        });
    }

    public function create()
    {
        //Using Vue3.
    }

    public function store(Request $request)
    {
        $request->validate([
            'conference_id' => 'required',
            'name' => 'required',
            'comment' => 'nullable',
        ]);

        $stage = new Stage([
            'conference_id' => $request->get('conference_id'),
            'name' => $request->get('name'),
            'comment' => $request->get('comment'),
        ]);

        $stage->save();

        return response()->json(['message' => 'Stage Created Successfully.'], 201);
    }

    public function show($id)
    {
        // Find the stage by its ID
        $stage = Stage::find($id);

        // If the stage was not found, return a 404 error
        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }

        // Return the stage data
        return response()->json($stage);
    }

    public function edit(Stage $stage)
    {
        //Using Vue3.
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'conference_id' => 'required',
            'name' => 'required',
            'comment' => 'nullable',
        ]);

        $stage = Stage::find($id);

        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }

        $stage->conference_id = $request->get('conference_id');
        $stage->name = $request->get('name');
        $stage->comment = $request->get('comment');

        $stage->save();

        return response()->json(['message' => 'Stage Updated Successfully.']);
    }

    public function destroy($id)
    {
        $stage = Stage::find($id);

        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }

        $stage->delete();

        return response()->json(['message' => 'Stage Deleted Successfully.']);
    }
}
