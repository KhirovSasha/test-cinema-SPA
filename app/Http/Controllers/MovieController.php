<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Services\MovieService;
use App\Http\Resources\MoviePaginationResource;

class MovieController extends Controller
{

    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function create(MovieRequest $request)
    {
        $data = $request->validated();

        $movie = $this->movieService->create($data);

        return response()->json(['message' => 'The film was successfully created'], 201);
    }

    public function edit(MovieRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->movieService->edit($data, $id);

        if (!$result) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json(['message' => 'Movie updated successfully'], 200);
    }

    public function delete($id)
    {
        $result = $this->movieService->delete($id);

        if (!$result) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json(['message' => 'Movie deleted successfully'], 200);
    }

    public function changeMovieStatus($id)
    {
        $result = $this->movieService->changeStatus($id);

        if (!$result) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json(['message' => 'Movie deleted successfully'], 200);
    }

    public function movies()
    {
        $movies = Movie::all();

        return response()->json($movies);
    }

    public function show($id)
    {
        $movie = Movie::with('genres')->findOrFail($id);

        return new MovieResource($movie);
    }

    public function paginationMovieGenre()
    {
        $movies = Movie::with('genres')->paginate(5);

        return MovieResource::collection($movies);
    }

    
    public function paginationMovies($id) 
    {
        $result = $this->movieService->paginationMovies($id);

        return  MoviePaginationResource::collection($result);
    }
}
