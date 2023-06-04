<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::getAllReservations();
        return view('reservations.index',compact('reservations'));
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
    
    public function store(UserRequest $request)
    {
        User::insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
            
        ]);

        return redirect()->route('users.index');
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
