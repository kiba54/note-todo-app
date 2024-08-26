<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Todo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Search for notes and todos based on a query
    public function search(Request $request)
    {
        $query = $request->query('query');

        $notes = Note::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->get();

        $todos = Todo::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return response()->json(['notes' => $notes, 'todos' => $todos]);
    }
}
