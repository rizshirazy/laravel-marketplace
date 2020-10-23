<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        $email = ($this->method() == 'POST')
            ? 'required|email|unique:users'
            : 'required|email|unique:users,id,' . $this->user;

        return [
            'name' => 'required|string|max:50',
            'email' => $email,
            'roles' => 'nullable|string|in:ADMIN,USER'
        ];
    }
}
