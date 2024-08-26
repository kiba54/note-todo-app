<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    // Get all notes for the current user
    public function index(Request $request)
    {
        $notes = Note::where('user_id', $request->user()->id)->get();
        return response()->json($notes);
    }

    // Create a new note
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:note_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $note = Note::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return response()->json($note, 201);
    }

    // Get details of a specific note
    public function show($noteId)
    {
        $note = Note::find($noteId);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        return response()->json($note);
    }

    // Update an existing note
    public function update(Request $request, $noteId)
    {
        $note = Note::find($noteId);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:note_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $note->update($request->only(['title', 'content', 'category_id']));
        return response()->json($note);
    }

    // Delete a note
    public function destroy($noteId)
    {
        $note = Note::find($noteId);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        $note->delete();
        return response()->json(['message' => 'Note deleted successfully']);
    }
}
