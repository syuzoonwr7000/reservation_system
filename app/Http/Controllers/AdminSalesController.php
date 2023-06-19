<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Reservation;

class AdminSalesController extends Controller
{
    public function index()
    {
        $all_sales = Sales::all();
        
        return view('admin.sales.index',compact('all_sales'));
    }
    
    public function show($id)
    {
        $sales = Sales::getSales($id);
        
        if(!$sales) {
            return redirect()->route('admin.sales.index')->with('error', 'Sales not found.');
        }
        
        return view('admin.sales.show',compact('sales'));
    }
    
    // public function edit()
    // {
    //     return view('admin.sales.edit');
    // }
    
    // public function update()
    // {
        
    // }
    // 
    // public function delete()
    // {
        
    // }
}
