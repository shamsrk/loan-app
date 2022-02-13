<?php
/**
 * This is a Model used for loan_details table
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sanctioned_amount',
        'interest_rate',
        'instalment_amount',
        'state',
        'state_updated_at'
    ];

    /**
     * Get the LoanRequest record of the LoanDetail.
     *
     */
    public function loanRequest()
    {
        return $this->belongsTo('App\LoanRequest');
    }

    /**
     * Get the WeekDay record of the LoanDetail.
     *
     */
    public function instalmentDay()
    {
        return $this->belongsTo('App\WeekDay');
    }

    /**
     * Get the PaymentInstalment records with the LoanDetail
     */
    public function paymentInstalments()
    {
        return $this->hasMany('App\PaymentInstalment');
    }
}