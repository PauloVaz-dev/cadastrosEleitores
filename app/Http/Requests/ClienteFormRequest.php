<?php

namespace Serbinario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ClienteFormRequest extends FormRequest
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

        return  [
            'name' => 'required|string|min:0|max:255',
            'address' => 'required|string|min:0|max:255'
        ];
    }


}
