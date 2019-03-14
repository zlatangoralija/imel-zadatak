<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostsCreateRequest extends Request
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
        //Validacija podataka koja govori koja polja su obavezna pirlikom kreiranja objave
        return [
            'title'        =>'required',
            'category_id'  =>'required',
            'photo_id'        =>'required',
            'body'         =>'required',
        ];
    }
}
