<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Sales;
use App\Http\Requests\ReservationStoreRequest;
use Carbon\Carbon;

class AdminReservationController extends Controller
{
    public function reservableIndex()//予約可能日一覧
    {
        $reservations = Reservation::getReservableReservations();
    
        // start_timeとend_timeをDateTime型に変換してからビューに渡す
        $reservations->transform(function ($reservation) {
            $reservation->start_time = \Carbon\Carbon::parse($reservation->start_time);
            $reservation->end_time = \Carbon\Carbon::parse($reservation->end_time);
            return $reservation;
        });
    
        return view('admin.reservations.reservable_index', compact('reservations'));
    }
    
    public function reservedIndex()//予約済み一覧
    {
        $reservations = Reservation::getReservedReservations();
    
        // start_timeとend_timeをDateTime型に変換してからビューに渡す
        $reservations->transform(function ($reservation) {
            $reservation->start_time = \Carbon\Carbon::parse($reservation->start_time);
            $reservation->end_time = \Carbon\Carbon::parse($reservation->end_time);
            return $reservation;
        });
        
        $reservations_by_dates = $reservations->groupBy(function ($reservation) {
            return $reservation->start_time->format('Y-m-d');
        });
    
        return view('admin.reservations.reserved_index', compact('reservations','reservations_by_dates'));
    }
    
    // 施術済みの予約を売上に登録する用
    public function addReservationToSales($id)
    {
        $reservation = Reservation::getReservation($id);
        
        if(!$reservation) {
            return redirect()->route('admin.reservations.reserbable_index')->with('error', 'Rservation not found.');
        }
        
        $sales = Sales::whereDate('sales_date', Carbon::parse($reservation->start_time)->toDateString())->first();
        
        $reservation->sales_id = $sales->id;
        $reservation->save();
        
        return redirect()->route('admin.reservations.reserved_index');
    }
    
    public function create()
    {
        return view('admin.reservations.create');
    }
    
    public function store(ReservationStoreRequest $request)
    {
        $startDateTime = $request['date'] . ' ' . $request['time'];
        $endDateTime = Carbon::parse($startDateTime)->addMinutes(90);
    
        Reservation::insert([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
        ]);
    
        return redirect()->route('admin.reservations.reservable_index');
    }
    
    public function cancel($reservation_id)
    {
        $reserved_reservations = Reservation::getReservedReservations();
        
        $reserved_reservation = Reservation::findOrFail($reservation_id);
        
        $reserved_reservation->update([
            'user_id' => '0',
            'reservable' => 1,
        ]);
            
        return redirect()->route('admin.reservations.reserved_index', compact('reserved_reservations'));
    }
    
    public function delete($id)
    {
        $reservation = Reservation::getReservation($id);
        
        if(!$reservation) {
            return redirect()->route('admin.reservations.reserbable_index')->with('error', 'User not found.');
        }
        
        $reservation->delete();
        return redirect()->route('admin.reservations.reservable_index');
    }
}
