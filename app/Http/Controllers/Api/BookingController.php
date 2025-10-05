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
        $bookings = Booking::all();
        return $bookings;
    }

    public function userBookings($user_id){
        $bookings = Booking::where('user_id', '=', $user_id);
        return $bookings;
    }

    // show and edit
    function show(string $id) {
        return Booking::find($id);
    }

    function destroy($id) {
        Booking::find($id)->delete();
        return 'deleted successfully';
    }

    function store(BookingRequest $request){
        $booking = new Booking();
        $booking->movie_id = $request->movie_id;
        $booking->user_id = $request->user_id;
        $booking->seat_number = $request->seat_number;
        $booking->party_date = $request->party_date;
        $booking->party_number = $request->party_number;
        $booking->price = $request->price;
        $booking->save();
        return response()->json([
            'message' => 'Inserting was successful',
            'booking' => $booking
        ], 201);
    }

    function update(BookingRequest $request, string $id){
        $booking = Booking::find($id);
        $booking->user_id = $request->user_id;
        $booking->movie_id = $request->movie_id;
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
