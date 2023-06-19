<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Consts\Pagination;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Sales extends Model
{
    use HasFactory,SoftDeletes;
    
    //カレント売上
    public static function getSales($id)
    {
        try {
            return static::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
    
    public function children_reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
