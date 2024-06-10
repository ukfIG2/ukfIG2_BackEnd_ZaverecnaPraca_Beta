<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /*public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'name' => 'required',
            'alt' => 'required',
            'comment' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $imageFile = $request->file('image');
        $imageName = $request->get('name'); // Use the name from the request

        try {
            // Store the image in the public folder and get the path
            $imagePath = $imageFile->storeAs('images', $imageName, 'public');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Image upload failed: ' . $e->getMessage()], 500);
        }

        // Create a new Image instance and save it to the database
        $image = new Image([
            'name' => $request->get('name'),
            'alt' => $request->get('alt'),
            'comment' => $request->get('comment'),
            //'file_name' => $imageName,
            //'image' => $imagePath,
            'path_to' => $imagePath,
        ]);

        $image->save();

        return response()->json(['message' => 'Image Uploaded Successfully.'], 201);

    }*/

    public function upload(Request $request)
    {
        $images = $request->file('images');
        $names = $request->get('names');
        $alts = $request->get('alts');
        $comments = $request->get('comments');

        if (!$images || count($images) === 0) {
            return response()->json(['message' => 'No files uploaded'], 400);
        }

        $imagePaths = [];

        foreach ($images as $index => $image) {
            $validator = Validator::make(
                [
                    'image' => $image,
                    'name' => $names[$index],
                    'alt' => $alts[$index],
                    'comment' => $comments[$index]
                ],
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                    'name' => 'required',
                    'alt' => 'required',
                    'comment' => 'nullable',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['Validation error' => $validator->errors()], 401);
            }

            try {
                // Store the image in the public folder and get the path
                $imagePath = $image->storeAs('images', $names[$index], 'public');
                $imagePaths[] = $imagePath;

                // Create a new Image instance and save it to the database
                $imageModel = new Image([
                    'name' => $names[$index],
                    'alt' => $alts[$index],
                    'comment' => $comments[$index],
                    'path_to' => $imagePath,
                ]);

                $imageModel->save();

            } catch (\Exception $e) {
                return response()->json(['message' => 'Image upload failed: ' . $e->getMessage()], 500);
            }
        }

        //return response()->json(['message' => 'Images Uploaded Successfully.', 'paths' => $imagePaths], 201);
        return response()->json(['message' => 'Images Uploaded Successfully.'], 201);
    }

}
