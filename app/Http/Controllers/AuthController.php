<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthUpdateRequest;

class AuthController extends Controller
{
    public function show()
    {
        $user = Auth::user();
       
        return view('auth.show', compact('user'));
    }
    
    public function edit()
    {
        $user = Auth::user();
        
        return view('auth.edit', compact('user'));
    }
    
    public function update(AuthUpdateRequest $request)
    {
        $user = Auth::user();
        
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
            
        return redirect()->route('auth.show');
    }
    
    public function delete()
    {
        $user = Auth::user();

        $user->delete();
        
        return redirect(view('auth/login'));
    }
}
