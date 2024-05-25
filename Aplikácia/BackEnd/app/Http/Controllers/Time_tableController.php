<?php

namespace App\Http\Controllers;

use App\Models\Time_table;
use Illuminate\Http\Request;

class Time_tableController extends Controller
{

    public function index()
    {
        return Time_table::with('stage')->get()->map(function ($time_table) {
            return [
                'id' => $time_table->id,
                'stage_id' => $time_table->stage_id,
                'time_start' => $time_table->time_start,
                'time_end' => $time_table->time_end,
                'comment' => $time_table->comment,
                //in case if needed timesamps
                'created_at' => $time_table->created_at,
                'updated_at' => $time_table->updated_at,
            ];
        });
    }

    public function create()
    {
        //using Vue3
    }

    public function store(Request $request)
    {
        $request->validate([
            'stage_id' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'comment' => 'nullable',
        ]);

        $time_table = new Time_table([
            'stage_id' => $request->get('stage_id'),
            'time_start' => $request->get('time_start'),
            'time_end' => $request->get('time_end'),
            'comment' => $request->get('comment'),
        ]);

        $time_table->save();

        return response()->json(['message' => 'Time Table Created Successfully.'], 201);
    }

    public function show($id)
    {
        // Find the time_table by its ID
        $time_table = Time_table::find($id);

        // If the time_table was not found, return a 404 error
        if (!$time_table) {
            return response()->json(['message' => 'Time Table not found'], 404);
        }

        /*return [
            'id' => $time_table->id,
            'stage_id' => $time_table->stage_id,
            'time_start' => $time_table->time_start,
            'time_end' => $time_table->time_end,
            'comment' => $time_table->comment,
            //in case if needed timesamps
            'created_at' => $time_table->created_at,
            'updated_at' => $time_table->updated_at,
        ];*/

        return response()->json($time_table);
    }

    public function edit(Time_table $time_table)
    {
        //Using Vue3.
    }

    public function update(Request $request, $id)
    {
        $time_table = Time_table::find($id);

        if (!$time_table) {
            return response()->json(['message' => 'Time Table not found'], 404);
        }

        $request->validate([
            'stage_id' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'comment' => 'nullable',
        ]);

        $time_table->stage_id = $request->get('stage_id');
        $time_table->time_start = $request->get('time_start');
        $time_table->time_end = $request->get('time_end');
        $time_table->comment = $request->get('comment');

        $time_table->save();

        return response()->json(['message' => 'Time Table Updated Successfully.'], 200);
    }
    
    public function destroy($id)
    {
        $time_table = Time_table::find($id);

        if (!$time_table) {
            return response()->json(['message' => 'Time Table not found'], 404);
        }

        $time_table->delete();

        return response()->json(['message' => 'Time Table Deleted Successfully.'], 200);
    }
}
