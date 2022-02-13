<?php
/**
 * Loan Repay Request
 */

namespace App\Http\Requests;

class LoanRepayRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Only admin can approve loan
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
            // loan_id must exists and active.
            'loan_id' => 'required|exists:loan_details,id,state,a',
        ];
    }
}