<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Share extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['note_id', 'todo_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
