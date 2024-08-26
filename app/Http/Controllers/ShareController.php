<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function shareNote(Request $request, $noteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id', // Ensure each user ID exists in the Users table
        ]);
    
        $note = Note::findOrFail($noteId);
    
        $userIds = $request->input('user_ids');
    
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                // Logic to share the note with this user
            }
        }
    
        return response()->json(['message' => 'Note shared successfully']);
    }
    
   
    public function shareTodo(Request $request, $todoId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id', // Ensure each user ID exists in the Users table
        ]);
        $todo = Todo::findOrFail($todoId);

        $userIds = $request->input('user_ids');

        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                // Logic to share the todo with this user
            }
        }

        return response()->json(['message' => 'Todo shared successfully']);
    }
}
