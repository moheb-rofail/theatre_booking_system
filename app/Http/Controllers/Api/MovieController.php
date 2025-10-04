<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Movie;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::orderBy('id', 'DESC')->get();
        //return response()->json($movies);
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        } else {
            return response()->json(['message' => 'Poster is required'], 422);
        }

        // Create movie
        $movie = Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'poster' => $posterPath,
            'TypeOfFilm' => $request->TypeOfFilm,
            'duration' => $request->duration,
        ]);

        // Response
        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Movie::find($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // Create movie
        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->poster = $posterPath;
        $movie->TypeOfFilm = $request->TypeOfFilm;
        $movie->duration = $request->duration;
        
        $movie->save();

        // Response
        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::find($id)->delete();
        return 'deleted successfully';
    }
}
