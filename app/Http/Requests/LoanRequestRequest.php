<?php

namespace App\Http\Requests;

class LoanRequestRequest extends ApiRequest
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
            'type' => 'required|in:p,h,c',
            'loan_term' => 'required|int|min:3|max:300',
            'amount' => 'required|int|min:50000',
        ];
    }
}
