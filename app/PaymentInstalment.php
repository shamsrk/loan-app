<?php
/**
 * This is a Model for payment_instalments table
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class PaymentInstalment extends Model
{
    /**
     * Get the loanDetail record of the PaymentInstalment
     */
    public function loanDetail()
    {
        return $this->belongsTo('App\LoanDetail');
    }
}