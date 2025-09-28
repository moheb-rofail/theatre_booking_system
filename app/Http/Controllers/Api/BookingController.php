<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

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
}
