<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Value;
use Illuminate\Support\Facades\DB;

class ValueController extends Controller
{
    public function index(){
        $values = Value::all();
        return response()->json(['message'=>'message', 'values'=>$values]);
    }

    public function update(Request $request) {
        $data = $request->all();

        // Example: $data = ['ticket_price' => 100, 'cola_price' => 30, 'popcorn_price' => 50, 'total_seats' => 60]

        foreach ($data as $key => $value) {
            Value::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
