<?php
/**
 * Handle action to create Loan Request
 */

namespace App\Actions\LoanRequest;

use App\LoanRequest;
use Illuminate\Http\Request;

class Create
{
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * Create constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle action to create new loan request for user
     *
     * @return LoanRequest
     */
    public function handle()
    {
        $loan_request = new LoanRequest();
        $loan_request->type = $this->request->type;
        $loan_request->loan_term = $this->request->loan_term;
        $loan_request->amount = $this->request->amount;
        $loan_request->state = 'pen';
        $loan_request->state_updated_at = now()->toDateTimeString();
        $loan_request->user()->associate(auth()->user());
        $loan_request->save();

        return $loan_request;
    }
}