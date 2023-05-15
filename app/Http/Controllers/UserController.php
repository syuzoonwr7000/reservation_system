<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

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
        return view('users.create');
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
