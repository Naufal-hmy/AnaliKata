<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    public function sentiment() { return $this->hasOne(CommentSentiment::class); }
    public function author() { return $this->belongsTo(Author::class); }
}
