<?php

namespace App\Http\Controllers;

use App\Actions\LoanRequest\Approve;
use App\Actions\LoanRequest\Create;
use App\Actions\LoanRequest\Repay;
use App\Http\Requests\LoanApproveRequest;
use App\Http\Requests\LoanRepayRequest;
use App\Http\Requests\LoanRequestRequest;

class LoanController extends Controller
{
    /**
     * Create new Loan Request
     *
     * @param LoanRequestRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(LoanRequestRequest $request)
    {
        $loan_request = (new Create($request))->handle();

        return response($loan_request, 201)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Approve loan request
     *
     * @param LoanApproveRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function approve(LoanApproveRequest $request)
    {
        $loan_detail = (new Approve($request))->handle();

        return response($loan_detail, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Repay loan instalment
     *
     * @param LoanRepayRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function repay(LoanRepayRequest $request)
    {
        $loan_detail = (new Repay($request))->handle();

        return response($loan_detail, 201)
            ->header('Content-Type', 'application/json');
    }
}
