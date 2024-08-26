<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{
    // Sync notes with the cloud
    public function syncNotes(Request $request)
    {
        // Fetch all notes for the current user
        $userId = $request->user()->id;
        $notes = Note::where('user_id', $userId)->get();

        // Iterate through notes and sync each one
        foreach ($notes as $note) {
            $response = Http::post('https://cloud.example.com/api/notes/sync', [
                'id' => $note->id,
                'title' => $note->title,
                'content' => $note->content,
                'category_id' => $note->category_id,
                'updated_at' => $note->updated_at,
            ]);

            // Check for conflicts
            if ($response->status() == 409) { // 409 Conflict
                $cloudNote = $response->json();
                if (strtotime($cloudNote['updated_at']) > strtotime($note->updated_at)) {
                    // Update local note if cloud version is newer
                    $note->update($cloudNote);
                } else {
                    // Otherwise, update the cloud version
                    Http::put("https://cloud.example.com/api/notes/{$note->id}", $note->toArray());
                }
            }
        }

        return response()->json(['message' => 'Notes synced successfully']);
    }

    // Sync todos with the cloud
    public function syncTodos(Request $request)
    {
        // Fetch all todos for the current user
        $userId = $request->user()->id;
        $todos = Todo::where('user_id', $userId)->get();

        // Iterate through todos and sync each one
        foreach ($todos as $todo) {
            $response = Http::post('https://cloud.example.com/api/todos/sync', [
                'id' => $todo->id,
                'title' => $todo->title,
                'description' => $todo->description,
                'due_date' => $todo->due_date,
                'priority' => $todo->priority,
                'completed' => $todo->completed,
                'updated_at' => $todo->updated_at,
            ]);

            // Check for conflicts
            if ($response->status() == 409) { // 409 Conflict
                $cloudTodo = $response->json();
                if (strtotime($cloudTodo['updated_at']) > strtotime($todo->updated_at)) {
                    // Update local todo if cloud version is newer
                    $todo->update($cloudTodo);
                } else {
                    // Otherwise, update the cloud version
                    Http::put("https://cloud.example.com/api/todos/{$todo->id}", $todo->toArray());
                }
            }
        }

        return response()->json(['message' => 'Todos synced successfully']);
    }
}
