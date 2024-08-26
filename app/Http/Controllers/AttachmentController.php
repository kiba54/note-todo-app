<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Todo;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    // Upload an attachment for a specific note
    public function uploadNoteAttachment(Request $request, $noteId)
    {
        $note = Note::find($noteId);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        // Logic for uploading an attachment goes here

        return response()->json(['message' => 'Attachment uploaded successfully']);
    }

    // Upload an attachment for a specific todo
    public function uploadTodoAttachment(Request $request, $todoId)
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        // Logic for uploading an attachment goes here

        return response()->json(['message' => 'Attachment uploaded successfully']);
    }
}
