<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TodosCategoriesMapping extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['todo_id', 'todo_category_id'];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }

    public function category()
    {
        return $this->belongsTo(TodoCategory::class, 'todo_category_id');
    }
}
