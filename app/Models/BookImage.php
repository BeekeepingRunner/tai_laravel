<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'src', //the path you uploaded the image
        'mime_type',
        'description',
        'alt',
      ];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
