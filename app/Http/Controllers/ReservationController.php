<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index');
    }

    public function store(ReservationRequest $request)
    {
        Reservation::create($request->validated());
        return redirect()->route('reservation.index')->with('success','Reservation submitted');
    }
}
