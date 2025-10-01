<?php

namespace App\Http\Controllers;

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
        return response()->json($movies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $request->validate([
            
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
