<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class GenreService
{
    /**
     * Create a new genre.
     *
     * @param  array  $data
     * @return \App\Models\Genre
     */
    public function create(array $data): Genre
    {

        $genre = Genre::create([
            'name' => $data['name'],
        ]);

        return $genre;
    }

    /**
     * Delete genre by id.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete($id): bool
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return false;
        }

        $genre->delete();

        return true;
    }

    /**
     * Update the specified genre by ID.
     *
     * @param  array  $data
     * @param  int  $id
     * @return bool
     */
    public function edit(array $data, $id): bool
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return false;
        }

        $genre->update($data);

        return true;
    }
}
