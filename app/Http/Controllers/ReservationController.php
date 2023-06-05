<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\ReservationStoreRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::getAllReservations();
    
        // start_timeとend_timeをDateTime型に変換してからビューに渡す
        $reservations->transform(function ($reservation) {
            $reservation->start_time = \Carbon\Carbon::parse($reservation->start_time);
            $reservation->end_time = \Carbon\Carbon::parse($reservation->end_time);
            return $reservation;
        });
    
        return view('reservations.index', compact('reservations'));
    }
    
    public function show($id)
    {
        $reservation = Reservation::getReservation($id);
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', '存在しない予約枠です。');
        }
        
        return view('reservations.show', compact('reservation'));
    }
    
    public function create()
    {
        return view('reservations.create');
    }
    
    public function store(ReservationStoreRequest $request)
    {
        $startDateTime = $request['date'] . ' ' . $request['time'];
        $endDateTime = Carbon::parse($startDateTime)->addMinutes(90);
    
        Reservation::insert([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
        ]);
    
        return redirect()->route('reservations.index');
    }
    
    public function edit($id)
    {
        $user = User::getUser($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        
        return view('users.edit', compact('user'));
    }
    
    public function update(UserRequest $request,$id)
    {
        $user = User::getUser($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
        ]);
            
        return redirect()->route('users.index');
    }
    
    public function delete($id)
    {
        $user = User::getUser($id);
        
        if(!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        
        $user->delete();
        return redirect()->route('users.index');
    }
}
