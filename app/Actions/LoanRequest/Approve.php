<?php
/**
 * Handle loan approve action by Admin
 */

namespace App\Actions\LoanRequest;

use App\LoanDetail;
use App\LoanRequest;
use App\WeekDay;
use Illuminate\Http\Request;

class Approve
{
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var LoanRequest $loan_request
     */
    protected $loan_request;

    /**
     * @var float
     */
    protected $interest_rate;

    /**
     * Create constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->loan_request = LoanRequest::find($request->loan_request_id);
        $this->interest_rate = env('INTEREST_RATE', 10);
    }

    /**
     * Approve the loan request
     */
    protected function approveRequest()
    {
        $this->loan_request->state = 'app';
        $this->loan_request->state_updated_at = now()->toDateTimeString();
        $this->loan_request->save();
    }

    /**
     * Calculate loan instalment amount
     * Installment = Amount * Rate * ( (1 + Rate) ^ Term / ( (1 + Rate) ^ Term - 1) )
     *
     * @return float|int
     */
    protected function instalmentAmount()
    {
        $amount = $this->loan_request->amount;
        $rate = $this->interest_rate * 0.01 / 12; // Monthly interest rate
        $term = $this->loan_request->loan_term; // Number of installments

        $instalment = $amount * $rate * (
                pow(1 + $rate, $term) / (pow(1 + $rate, $term) - 1)
            );

        return $instalment;
    }

    /**
     * Create loan detail for the loan request
     */
    protected function createLoanDetail()
    {
        $loan_detail = new LoanDetail();
        $loan_detail->sanctioned_amount = $this->loan_request->amount;
        $loan_detail->interest_rate = $this->interest_rate;
        $loan_detail->instalment_amount = $this->instalmentAmount();
        $loan_detail->state = 'a';
        $loan_detail->state_updated_at = now()->toDateTimeString();

        // Select a random instalment day
        $instalment_day = WeekDay::inRandomOrder()->first();

        $loan_detail->instalmentDay()->associate($instalment_day);
        $loan_detail->loanRequest()->associate($this->loan_request);
        $loan_detail->save();
    }

    /**
     * Handle the loan approval action
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function handle()
    {
        $this->approveRequest();

        $this->createLoanDetail();

        return $this->loan_request->loanDetail()->first();
    }
}