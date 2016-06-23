<?php

namespace App\Http\Requests\Api\v2;

use App\Http\Requests\Request;

class BlockRequest extends Request
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
            'strBlockName'          =>      'required',
            'intColumnNo'           =>      'required|integer',
            'intLevelNo'            =>      'required|integer',
            'intUnitType'           =>      'required|integer'
        ];
    }

    public function message(){

        return [
            'strBlockName|required'         =>      'Block name cannot be blank.',
            'intColumnNo|required'          =>      'Column cannot be blank.',
            'intLevelNo|required'           =>      'Level cannot be blank.',
            'intUnitType|required'          =>      'Please choose unit type.',
            'intColumnNo|integer'           =>      'Column should be an integer.',
            'intLevelNo|integer'            =>      'Level should be an integer.'
        ];

    }
}
