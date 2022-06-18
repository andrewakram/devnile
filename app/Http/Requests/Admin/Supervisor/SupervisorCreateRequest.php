<?php

namespace App\Http\Requests\Admin\Supervisor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SupervisorCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::guard('admin')->user())
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:supervisors,email',
            'phone' => 'required|unique:supervisors,phone',
            'password' => 'sometimes|',
            'active' => 'required|in:0,1',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg',
        ];
    }
}
