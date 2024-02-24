<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function create(GenreRequest $request)
    {
        $data = $request->validated();

        $genre = $this->genreService->create($data);

        return response()->json(['message' => 'Жанр успішно створений', 'genre' => $genre], 201);
    }

    public function edit(GenreRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->genreService->edit($data, $id);

        if (!$result) {
            return response()->json(['message' => 'Жанр не знайдено'], 404);
        }

        return response()->json(['message' => 'Жанр успішно оновлено', 'genre' => $result], 200);
    }

    public function delete($id)
    {
        $result = $this->genreService->delete($id);

        if (!$result) {
            return response()->json(['message' => 'Жанр не знайдено'], 404);
        }

        return response()->json(['message' => 'Жанр успішно видалений'], 200);
    }

    public function index()
    {
        $genres = Genre::all();

        return response()->json($genres);
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);

        return response()->json($genre);
    }
}
