<?php

namespace sisLaravel\Http\Requests;

use sisLaravel\Http\Requests\Request;

class ArticuloFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //autoriza la validacion
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //aqui hacemos la validacion de campos y es requerdo o no
        return [
            'idcategoria'=>'required',//noombrecate no es de la base de datos sino del formulario que vamos a usar
            'codigo'=>'required|max:50',
            'nombrearti'=>'required|max:100',
            'stock'=>'required|numeric',
            'descripcionarti'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png',
        ];
    }
}
