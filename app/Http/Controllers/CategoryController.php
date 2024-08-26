<?php

namespace App\Http\Controllers;

use App\Models\NoteCategory;
use App\Models\TodoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Get all note categories for the current user
    public function getNoteCategories(Request $request)
    {
        $categories = NoteCategory::where('user_id', $request->user()->id)->get();
        return response()->json($categories);
    }

    // Create a new note category
    public function createNoteCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = NoteCategory::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    // Get all todo categories for the current user
    public function getTodoCategories(Request $request)
    {
        $categories = TodoCategory::where('user_id', $request->user()->id)->get();
        return response()->json($categories);
    }

    // Create a new todo category
    public function createTodoCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = TodoCategory::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }
}
