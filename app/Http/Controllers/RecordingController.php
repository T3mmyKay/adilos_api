<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecordingResource;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordingController extends Controller
{
    public function index()
    {
        $recordings = RecordingResource::collection(Recording::all());
        return response()->json($recordings);
    }
    public function show($id)
    {
        $recording = new RecordingResource(Recording::findOrFail($id));
        return response()->json($recording);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'url' => 'required|file|mimes:mp4|max:102400', // Adjust file type and size as needed
            'views' => 'integer',
            'size' => 'string',
        ]);

        $path = $request->file('url')->store('recordings');

        $recording = Recording::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'url' => $path, // Store the file path in the database
            'views' => $request->views,
            'size' => $request->size,
        ]);

        return new RecordingResource($recording);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string',
            'url' => 'file|mimes:mp4|max:102400', // Adjust file type and size as needed
            'views' => 'integer',
            'size' => 'string',
        ]);

        $recording = Recording::find($id);

        if ($request->hasFile('url')) {
            // Delete the previous file if updating
            Storage::delete($recording->url);

            // Upload the new file
            $recording->url = $request->file('url')->store('recordings');
        }

        // Update other fields
        $recording->update($request->except('url'));

        return new RecordingResource($recording);
    }
    public function destroy($id)
    {
        $recording = Recording::findOrFail($id);
        $recording->delete();

        return response()->json(null, 204);
    }
}
