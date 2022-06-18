<?php

namespace App\Http\Requests\Supervisor\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::guard('supervisor')->user())
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
            'row_id' => 'required|exists:categories,id',
            'name' => 'required|min:3|max:191',
            'icon' => 'required|min:3|max:20',
        ];
    }
}
