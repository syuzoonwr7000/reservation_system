<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAllUsers();
        return view('users.index',compact('users'));
    }
    
    public function show($id)
    {
        $user = User::getUser($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        
        return view('users.show', compact('user'));
    }
    
    public function create()
    {
        //
    }
    
    public function store()
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update($id)
    {
        //
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
