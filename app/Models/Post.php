<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class,'author_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class,'on_post');
    }
    
    public function scopeAuthor($query,$arg){
        
        return $query->where('author_id',$arg)->orderBy('created_at', 'desc');
    }
}
