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
        // return $bookings = Booking::all();
        $bookings = Booking::with('user','movie')->get();
        return $bookings;
    }

    public function userBookings($user_id){
        $bookings = Booking::where('user_id', '=', $user_id)->with('users');
        return $bookings;
    }

    // show and edit
    function show(string $id) {
        return Booking::find($id);
    }

    function destroy($id){
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully'
        ], 200);
    }


    function store(BookingRequest $request){
        // Check if seat is already booked for this movie and date
        $existingBooking = Booking::where('movie_id', $request->movie_id)
            ->where('party_date', $request->party_date)
            ->where('seat_number', $request->seat_number)
            ->first();
            
        if ($existingBooking) {
            return response()->json([
                'message' => 'Seat is already booked',
                'error' => 'This seat is already reserved for the selected show'
            ], 409);
        }
        
        $booking = new Booking();
        $booking->movie_id = $request->movie_id;
        $booking->user_id = $request->user_id;
        $booking->seat_number = $request->seat_number;
        $booking->party_date = $request->party_date;
        $booking->party_number = $request->party_number;
        $booking->price = $request->price;
        $booking->save();
        
        return response()->json([
            'message' => 'Booking created successfully',
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
        return "updating was successful";
    }

    function booked_seats($party_date, $movie_id){
        $booked_seats = DB::table('bookings')
            ->where('party_date', '=', $party_date)
            ->where('movie_id', '=', $movie_id)
            ->pluck('seat_number')
            ->toArray();
        return response()->json($booked_seats);
    }

}
