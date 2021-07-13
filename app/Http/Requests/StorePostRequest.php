<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->role == "admin" || $this->user()->role == "author") return true;
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('message.required',['attribute' => ':attribute']),
            'unique' => __('message.unique' , ['attribute' => ':attribute'])
        ];
    }
}
