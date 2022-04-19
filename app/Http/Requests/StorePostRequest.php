<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Gate::allows('user-exhausted'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->input('category')) {
            $rules = [
                'title' => 'required|max:80',
                'text' => 'required|max:4000'
            ];
        } else {
            $rules = [
                'title' => 'required|max:80',
                'text' => 'required|max:4000',
                'category' => 'required|exists:posts_categories,id'
            ];
        }

        return $rules;
    }
}
