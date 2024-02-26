<?php

namespace App\Services;

use App\Models\GenreMovie;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    /**
     * Create a new movie.
     *
     * @param  array  $data
     * @return \App\Models\Movie
     */
    public function create(array $data): Movie
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imagePath = $image->store('public');
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = Storage::url('public/default-image.jpg');
        }

        $movie = Movie::create([
            'name' => $data['name'],
            'url' => $imageUrl,
            'publish_status' => 'underConsideration',
        ]);

        $genres = $data['genres'];

        foreach ($genres as $genre) {
            GenreMovie::create([
                'genre_id' => $genre,
                'movie_id' => $movie->id,
            ]);
        }

        return $movie;
    }

    /**
     * Delete movie by id.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete($id): bool
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return false;
        }

        $movie->delete();

        $imageUrl = $movie->url;
        $imageUrl = str_replace('/storage/', '/public/', $imageUrl);

        if ($imageUrl !== '/public/default-image.jpg' && Storage::exists($imageUrl)) {
            Storage::delete($imageUrl);
        }
        
        return true;
    }

    /**
     * Update the specified movie by ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return bool
     */
    public function edit(array $data, $id): bool
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return false;
        }

        $movie->update($data);

        return true;
    }

    /**
     * Change status movie by ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function changeStatus($id): bool
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return false;
        }

        $movie->publish_status = $movie->publish_status === 'published' ? 'underConsideration' : 'published';

        $movie->save();

        return true;
    }

    public function paginationMovies($id) {
       
        $movies = Movie::whereHas('genres', function ($query) use ($id) {
            $query->where('genre_id', $id);
        })->paginate(2);

        return  $movies;

    }
}
