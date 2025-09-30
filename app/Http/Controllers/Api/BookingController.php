<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Movie;

class BookingController extends Controller
{
    function index() {
        return Booking::orderBy('id','DESC')->latest()->paginate(10);
    }

    // show and edit
    function show(string $id) {
        return Booking::find($id);
    }

    function destroy($id) {
        $booking = Booking::find($id);
        $booking->delete();
        return 'deleted successfully';
    }

    function store(BookingRequest $request){
        $booking = new Booking();
        $booking->id = $request->id;
        $booking->user_id = $request->user_id;
        $booking->seat_number = $request->seat_number;
        $booking->party_date = $request->party_date;
        $booking->party_number = $request->party_number;
        $booking->price = $request->price;
        $booking->save();
        return "inserting was successful";
    }

    function update(BookingRequest $request, string $id){
        $booking = Booking::find($id);
        $booking->user_id = $request->user_id;
        $booking->seat_number = $request->seat_number;
        $booking->party_date = $request->party_date;
        $booking->party_number = $request->party_number;
        $booking->price = $request->price;
        $booking->save();
        //Booking::find($id)->update($booking);
        return "updating was successful";
    }



    // store movies data  by admin
    public function storeMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'poster' => 'nullable|image',
            'TypeOfFilm' => 'required|string',
            'duration' => 'required|string|min:1',
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


    // get all movies data to show in user side (home page for user)
    public function getMovies()
    {
        $movies = Movie::orderBy('id', 'DESC')->get();
        return response()->json($movies);
    }
}
