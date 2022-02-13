<?php
/**
 * Request to approve loan
 */

namespace App\Http\Requests;

class LoanApproveRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Only admin can approve loan requests
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // loan_request_id must exists but not already approved.
            'loan_request_id' => 'required|exists:loan_requests,id,state,!app',
        ];
    }
}