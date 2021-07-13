<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->role == "admin" || $this->user()->id == $this->request->get('author_id')) return true;
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $post = Post::find($this->request->get('post_id'));
        return [
            'title' => 'required|unique:posts,title,'.$post->title.',title',
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
