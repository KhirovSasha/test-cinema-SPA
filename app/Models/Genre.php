<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the movies associated with the genre.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id');
    }
}
