<?php

namespace App\Http\Requests\Api\v2;

use App\Http\Requests\Request;

class AddDeceasedRequest extends Request
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
            'strFirstName'      =>  'required',
            'strLastName'       =>  'required',
            'intStorageTypeId'  =>  'required',
            'dateDeath'         =>  'required',
            'deciAmountPaid'    =>  'required',
            'intPaymentType'    =>  'required'
        ];
    }

    public function messages(){

        return [
            'strFirstName.required'     =>  'First name cannot be blank',
            'strLastName.required'      =>  'Last name cannot be blank',
            'intStorageTypeId.required' =>  'Choose storage type to be inserted.',
            'dateDeath.required'        =>  'Date of death is required.',
            'deciAmountPaid.required'   =>  'Enter amount paid.',
            'intPaymentType.required'   =>  'Choose type of payment.'
        ];

    }
}
