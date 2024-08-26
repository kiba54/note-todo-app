<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    // Get all todos for the current user
    public function index(Request $request)
    {
        $todos = Todo::where('user_id', $request->user()->id)->get();
        return response()->json($todos);
    }

    // Create a new todo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $todo = Todo::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'completed' => false,
        ]);

        return response()->json($todo, 201);
    }

    // Get details of a specific todo
    public function show($todoId)
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        return response()->json($todo);
    }

    // Update an existing todo
    public function update(Request $request, $todoId)
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'due_date' => 'sometimes|required|date',
            'priority' => 'sometimes|required|integer',
            'completed' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $todo->update($request->only(['title', 'description', 'due_date', 'priority', 'completed']));
        return response()->json($todo);
    }

    // Delete a todo
    public function destroy($todoId)
    {
        $todo = Todo::find($todoId);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $todo->delete();
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
