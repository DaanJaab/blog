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
        return true;
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
                'title' => 'required',
                'description' => 'required'
            ];
        } else {
            $rules = [
                'title' => 'required',
                'description' => 'required',
                'category' => 'required'
            ];
        }
        //dd(request()->input('category'));
        //$this->route('category')
        //request()->category
        return $rules;
    }
}
