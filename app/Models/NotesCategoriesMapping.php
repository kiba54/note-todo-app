<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class NotesCategoriesMapping extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['note_id', 'note_category_id'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function category()
    {
        return $this->belongsTo(NoteCategory::class, 'note_category_id');
    }
}
