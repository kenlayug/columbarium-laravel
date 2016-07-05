<?php

namespace App\Http\Requests\Api\v2;

use App\Http\Requests\Request;

class RequirementRequest extends Request
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
            'strRequirementName'        =>      'required|string'
        ];
    }

}
