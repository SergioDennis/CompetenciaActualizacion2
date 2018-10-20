<?php

namespace sisLaravel\Http\Requests;

use sisLaravel\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
        return [
            'nombrecate'=>'required|max:50',//noombrecate no es de la base de datos sino del formulario que vamos a usar
            'descripcioncate'=>'max:256',

        ];
    }
}
