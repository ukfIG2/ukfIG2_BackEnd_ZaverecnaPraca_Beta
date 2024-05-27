<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{

    public function index()
    {
        return Sponsor::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'conference_id' => 'required',
            'url' => 'nullable',
            'comment' => 'nullable',
        ]);

        $sponsor = new Sponsor([
            'name' => $request->get('name'),
            'conference_id' => $request->get('conference_id'),
            'url' => $request->get('url'),
            'comment' => $request->get('comment'),
        ]);

        $sponsor->save();

        return response()->json(['message' => 'Sponsor Created Successfully.'], 201);
    }

    public function show($id)
    {
        $sponsor = Sponsor::find($id);

        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        return $sponsor;
    }

    public function update(Request $request, $id)
    {
        $sponsor = Sponsor::find($id);

        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        $sponsor->name = $request->get('name');
        $sponsor->conference_id = $request->get('conference_id');
        $sponsor->url = $request->get('url');
        $sponsor->comment = $request->get('comment');

        $sponsor->save();

        return response()->json(['message' => 'Sponsor Updated Successfully.'], 200);
    }


    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);

        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        $sponsor->delete();

        return response()->json(['message' => 'Sponsor Deleted Successfully.'], 200);
    }
}
