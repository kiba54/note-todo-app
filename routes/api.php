<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AttachmentController;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });



// Auth
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// profile
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{userId}', [UserController::class, 'show']);
    Route::put('/users/{userId}', [UserController::class, 'update']);
});

// Note API
Route::middleware('auth:sanctum')->group(function () {
Route::get('/notes', [NoteController::class, 'index']);
Route::post('/notes', [NoteController::class, 'store']);
Route::get('/notes/{noteId}', [NoteController::class, 'show']);
Route::put('/notes/{noteId}', [NoteController::class, 'update']);
Route::delete('/notes/{noteId}', [NoteController::class, 'destroy']);
});


// Todo API
Route::middleware('auth:sanctum')->group(function () {
Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);
Route::get('/todos/{todoId}', [TodoController::class, 'show']);
Route::put('/todos/{todoId}', [TodoController::class, 'update']);
Route::delete('/todos/{todoId}', [TodoController::class, 'destroy']);
});

// Category API
Route::middleware('auth:sanctum')->group(function () {
Route::get('/categories/notes', [CategoryController::class, 'getNoteCategories']);
Route::post('/categories/notes', [CategoryController::class, 'createNoteCategory']);
Route::get('/categories/todos', [CategoryController::class, 'getTodoCategories']);
Route::post('/categories/todos', [CategoryController::class, 'createTodoCategory']);
});



// Sharing API
Route::middleware('auth:sanctum')->group(function () {
Route::post('/shares/notes/{noteId}', [ShareController::class, 'shareNote']);
Route::post('/shares/todos/{todoId}', [ShareController::class, 'shareTodo']);
});

// Sync API
Route::middleware('auth:sanctum')->group(function () {
Route::post('/sync/notes', [SyncController::class, 'syncNotes']);
Route::post('/sync/todos', [SyncController::class, 'syncTodos']);
});

// Search API
Route::middleware('auth:sanctum')->group(function () {
Route::get('/search', [SearchController::class, 'search']);
});

// Attachment API
Route::middleware('auth:sanctum')->group(function () {
Route::post('/notes/{noteId}/attachments', [AttachmentController::class, 'uploadNoteAttachment']);
Route::post('/todos/{todoId}/attachments', [AttachmentController::class, 'uploadTodoAttachment']);
});

