<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    // One Book was put in a base by one User
    public function userOwner()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * 
     * Get the image associated with the book
     */
    public function image()
    {
        return $this->hasOne(BookImage::class);
    }
}
