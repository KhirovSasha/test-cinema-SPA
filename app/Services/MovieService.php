<?php

namespace App\Services;

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
        $image = $data['image'];

        $imagePath = $image->store('public/');

        $imageUrl = Storage::url($imagePath);

        $movie = Movie::create([
            'name' => $data['name'],
            'url' => $imageUrl,
            'publish_status' => 'underConsideration',
        ]);

        return $movie;
    }

    /**
     * Create movie by id.
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
}
