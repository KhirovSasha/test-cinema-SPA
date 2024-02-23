<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'publish_status',
    ];

    /**
     * The valid values for publish_status.
     *
     * @var array
     */
    public static $enum = ['published', 'underConsideration'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'url' => 'url'
    ];

    /**
     * Get the genres associated with the movie.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'publish_status' => 'required|string|in:' . implode(',', self::$enum),
        ];
    }
}
