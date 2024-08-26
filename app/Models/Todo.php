<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Todo extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'priority', 'completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TodoCategory::class);
    }
}
