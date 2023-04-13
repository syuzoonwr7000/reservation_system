<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $user_id = $this->route('user') ? $this->route('user')->id : null;
        
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->where(function ($query) use ($user_id) {
                return $query->whereNull('deleted_at')->where('id', '!=', $user_id);
            })],
            'password' => 'required|min:8|confirmed',
            'role' => 'required|numeric|min:1|max:5'
        ];
    }
}
