<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class BookingController extends Controller
{
    public function index() {
        $movies = Movie::orderBy('id','DESC')->get();
        $movies->map(function($movie) {
            $movie->poster = asset('storage/posters/' . basename($movie->poster));
            return $movie;
        });
        return response()->json(['data' => $movies]);
    }


    // show and edit
    function show(string $id) {
        // return Booking::find($id);
        return Booking::find($id);
    }

    function destroy($id) {
        Booking::find($id)->delete();
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

    function booked_seats($party_date, $party_number){
        $booked_seats = DB::table('bookings')
        ->where('party_date','=', $party_date)
        ->where('party_number', '=', $party_number)
        ->pluck('seat_number');
        return $booked_seats;
    }

}
