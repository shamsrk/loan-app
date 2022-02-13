<?php
/**
 * Handle loan Repay action
 */

namespace App\Actions\LoanRequest;

use App\LoanDetail;
use App\PaymentInstalment;
use Illuminate\Http\Request;

class Repay
{
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var LoanDetail $loan_detail
     */
    protected $loan_detail;

    /**
     * Create constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->loan_detail = LoanDetail::find($request->loan_id);
    }

    /**
     * Create new payment installment
     */
    protected function createPaymentInstalment()
    {
        $payment_instalment = new PaymentInstalment();
        $payment_instalment->loanDetail()->associate($this->loan_detail);
        $payment_instalment->save();
    }

    /**
     * Handle the loan repayment action
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function handle()
    {
        $this->createPaymentInstalment();

        $payment_installment_count = $this->loan_detail->paymentInstalments()->count();
        $loan_terms = $this->loan_detail->loanRequest()->first()->loan_term;

        // Check if all the instalments are paid then close the loan
        if ($payment_installment_count == $loan_terms) {
            $this->loan_detail->state = 'c';
            $this->loan_detail->state_updated_at = now()->toDateTimeString();
            $this->loan_detail->save();
        }

        return $this->loan_detail;
    }
}