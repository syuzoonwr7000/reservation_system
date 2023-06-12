<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Consts\Pagination;

class Reservation extends Model
{
    use HasFactory,softDeletes;
    
    protected $fillable = [
         'user_id', 
         'reservable',
    ];
    
    //予約一覧
    public static function getReservableReservations()
    {
        return  static::where('reservable',1)->get();
    }
    
    //カレント予約
    public static function getReservation($id)
    {
        try {
            return static::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
    
    public function parent_user()
    {
      return this->belongsTo(User::class,'user_id');
    }
    
}
