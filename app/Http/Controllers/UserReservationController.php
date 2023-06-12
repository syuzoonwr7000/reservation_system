<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;

class UserReservationController extends Controller
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
        
        return view('reservables.index',compact('reservations'));
    }
    
    public function reservedIndex()
    {
         $user_id = Auth::id();
         
         $reserved_reservations = Reservation::where('user_id',$user_id)->get();
         
         return view('reservables.reserved_index',compact('reserved_reservations'));
    }
    
    public function edit()
    {
        //
    }
    
    public function regist()
    {
        //
    }
    
    public function show($reservation_id)
    {
        $user = Auth::user();
        
        $reserved_reservation = Reservation::findOrFail($reservation_id);
       
        return view('reservables.show',compact('user','reserved_reservation'));
        
    }
    
    public function cancel($reservation_id)
    {
        $user_id = Auth::id();
         
        $reserved_reservations = Reservation::where('user_id',$user_id)->get();
        
        Reservation::findOrFail($reservation_id)->update([
            'user_id' => '0',
            'reservable' => 1,
            ]);
            
        return redirect()->route('reservables.resereved_index',compact('reserved_reservations'));
    }
}
