<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Consts\Pagination;

class Sales extends Model
{
    use HasFactory,SoftDeletes;
    
    public function children_reservations()
    {
        return $this->hasMany(Resservation::class);
    }
}
