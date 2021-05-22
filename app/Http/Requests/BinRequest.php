<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BinRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'color' => 'required|max:255',
            'day' => 'required|integer',
            'start_at' => 'notIn:Choose an hour',
            'end_at' => 'notIn:Choose an hour'
        ];
    }

    public function messages()
    {
        $msg = 'This field is required';

        return [
            'name.required' => $msg,
            'color.required' => $msg,
            'day.required' => $msg,
            'start_at.not_in' => $msg,
            'end_at.not_in' => $msg,
        ];
    }
}
