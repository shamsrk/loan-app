<?php

namespace Tests\Traits;


use App\LoanDetail;
use App\LoanRequest;
use App\WeekDay;

trait LoanTrait
{
    /**
     * @param $user
     * @return LoanRequest
     */
    protected function createLoanRequest($user)
    {
        $loan_request = new LoanRequest();
        $loan_request->type = 'p';
        $loan_request->loan_term = 60;
        $loan_request->amount = 50000;
        $loan_request->state = 'pen';
        $loan_request->state_updated_at = now()->toDateTimeString();
        $loan_request->user()->associate($user);
        $loan_request->save();

        return $loan_request;
    }

    protected function approveLoan($loan_request)
    {
        $loan_request->state = 'app';
        $loan_request->state_updated_at = now()->toDateTimeString();
        $loan_request->save();

        return $this->createLoanDetail($loan_request);
    }

    /**
     * Create loan detail for the loan request
     */
    protected function createLoanDetail($loan_request)
    {
        $loan_detail = new LoanDetail();
        $loan_detail->sanctioned_amount = $loan_request->amount;
        $loan_detail->interest_rate = 10;
        $loan_detail->instalment_amount = 1000;
        $loan_detail->state = 'a';
        $loan_detail->state_updated_at = now()->toDateTimeString();

        // Select a random instalment day
        $instalment_day = WeekDay::inRandomOrder()->first();

        $loan_detail->instalmentDay()->associate($instalment_day);
        $loan_detail->loanRequest()->associate($loan_request);
        $loan_detail->save();

        return $loan_detail;
    }
}