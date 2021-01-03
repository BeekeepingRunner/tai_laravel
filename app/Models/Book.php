<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    /**
     * 
     * Get the image associated with the book
     */
    public function image()
    {
        return $this->hasOne(BookImage::class);
    }
}
