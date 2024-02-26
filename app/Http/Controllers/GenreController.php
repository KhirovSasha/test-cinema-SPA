<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Services\GenreService;

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

        return response()->json(['message' => 'The genre has been successfully created'], 201);
    }

    public function edit(GenreRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->genreService->edit($data, $id);

        if (!$result) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        return response()->json(['message' => 'Genre successfully updated'], 200);
    }

    public function delete($id)
    {
        $result = $this->genreService->delete($id);

        if (!$result) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        return response()->json(['message' => 'Genre successfully deleted'], 200);
    }

    public function genres()
    {
        $genres = Genre::all();

        return GenreResource::collection($genres);
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);

        return new GenreResource($genre);
    }
}
