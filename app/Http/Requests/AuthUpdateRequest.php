<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $user = Auth::user();
        $user_id = $user ? $user->id : null;
        
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_id,
            'password' => 'required|min:8|confirmed',
        ];
    }
}
