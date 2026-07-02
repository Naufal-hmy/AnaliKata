<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function comments() { return $this->hasMany(Comment::class); }
}
