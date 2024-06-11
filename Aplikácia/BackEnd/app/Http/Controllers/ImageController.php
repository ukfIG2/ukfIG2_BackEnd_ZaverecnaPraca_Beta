<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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
            return response()->json(['message' => 'No files uploaded.'], 400);
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

    public function index()
    {
        $images = Image::all();

        return response()->json($images, 200);
    }

    /*public function delete($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }*/

    public function delete($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Delete the file from storage
        if (Storage::disk('public')->exists($image->path_to)) {
            Storage::disk('public')->delete($image->path_to);
        }

        $image->delete();

        return response()->json(['message' => 'Image and file deleted successfully'], 200);
    }

   /* public function update(Request $request, $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alt' => 'required',
            'comment' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        $image->name = $request->get('name');
        $image->alt = $request->get('alt');
        $image->comment = $request->get('comment');

        $image->save();

        return response()->json(['message' => 'Image updated successfully'], 200);
    }*/

    public function update(Request $request, $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alt' => 'required',
            'comment' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation error' => $validator->errors()], 401);
        }

        // Get the old and new names
        $oldName = $image->name;
        $newName = $request->get('name');

        // Update the image name and alt text
        $image->name = $newName;
        $image->alt = $request->get('alt');
        $image->comment = $request->get('comment');

        // If the name has changed, update the file name and path_to
        if ($oldName !== $newName) {
            // Get the old path
            $oldPath = $image->path_to;

            // Generate the new path
            $newPath = str_replace($oldName, $newName, $oldPath);

            // Rename the file
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->move($oldPath, $newPath);
            }

            // Update the path_to in the database
            $image->path_to = $newPath;
        }

        $image->save();

        return response()->json(['message' => 'Image updated successfully'], 200);
    }

    public function show($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Return only the 'alt' and 'path_to' attributes
        return response()->json([
            'alt' => $image->alt,
            'path_to' => $image->path_to
        ], 200);
    }
}
