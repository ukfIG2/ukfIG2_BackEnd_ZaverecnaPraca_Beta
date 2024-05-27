<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        return Presentation::with('time_table')->get()->map(function ($presentation) {
            return [
                'id' => $presentation->id,
                'time_table_id' => $presentation->time_table_id,
                'name' => $presentation->name,
                'short_description' => $presentation->short_description,
                'long_description' => $presentation->long_description,
                'max_capacity' => $presentation->max_capacity,
                'comment' => $presentation->comment,
                //in case if needed timesamps
                'created_at' => $presentation->created_at,
                'updated_at' => $presentation->updated_at,
            ];
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'time_table_id' => 'required',
            'name' => 'required',
            'short_description' => 'nullable',
            'long_description' => 'nullable',
            'max_capacity' => 'required',
            'comment' => 'nullable',
        ]);

        $presentation = new Presentation([
            'time_table_id' => $request->get('time_table_id'),
            'name' => $request->get('name'),
            'short_description' => $request->get('short_description'),
            'long_description' => $request->get('long_description'),
            'max_capacity' => $request->get('max_capacity'),
            'comment' => $request->get('comment'),
        ]);

        $presentation->save();

        return response()->json(['message' => 'Presentation Created Successfully.'], 201);
    }

    public function show($id)
    {
        $time_table = Presentation::find($id);

        if (!$time_table) {
            return response()->json(['message' => 'Presentation not found'], 404);
        }

        return [
            'id' => $time_table->id,
            'time_table_id' => $time_table->time_table_id,
            'name' => $time_table->name,
            'short_description' => $time_table->description,
            'long_description' => $time_table->long_description,
            'max_capacity' => $time_table->max_capacity,
            'comment' => $time_table->comment,
            'created_at' => $time_table->created_at,
            'updated_at' => $time_table->updated_at,
        ];
    }

    public function update(Request $request, $id)
    {
        $presentation = Presentation::find($id);

        if (!$presentation) {
            return response()->json(['message' => 'Presentation not found'], 404);
        }

        $request->validate([
            'time_table_id' => 'required',
            'name' => 'required',
            'short_description' => 'nullable',
            'long_description' => 'nullable',
            'max_capacity' => 'required',
            'comment' => 'nullable',
        ]);

        $presentation->time_table_id = $request->get('time_table_id');
        $presentation->name = $request->get('name');
        $presentation->short_description = $request->get('short_description');
        $presentation->long_description = $request->get('long_description');
        $presentation->max_capacity = $request->get('max_capacity');
        $presentation->comment = $request->get('comment');
        

        $presentation->save();

        return response()->json(['message' => 'Presentation Updated Successfully.'], 200);
    }

    public function destroy($id)
    {
        $presentation = Presentation::find($id);

        if (!$presentation) {
            return response()->json(['message' => 'Presentation not found'], 404);
        }

        $presentation->delete();

        return response()->json(['message' => 'Presentation Deleted Successfully.'], 200);
    }
}
