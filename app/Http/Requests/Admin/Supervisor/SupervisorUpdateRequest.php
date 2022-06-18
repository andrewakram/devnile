<?php

namespace App\Http\Requests\Admin\Supervisor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'row_id' => 'required|exists:supervisors,id',
            'name' => 'required',
            'email' => 'required|email|unique:supervisors,email,' . $request->row_id,
            'phone' => 'required|unique:supervisors,phone,' . $request->row_id,
            'password' => 'sometimes|nullable',
            'active' => 'required|in:0,1',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg',
        ];
    }
}
