<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Attachment extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['note_id', 'todo_id', 'file_path'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
