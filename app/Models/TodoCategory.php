<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class TodoCategory extends Model
{
    use HasApiTokens, HasFactory;
    
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'category_id');
    }
}
