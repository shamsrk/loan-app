<?php
/**
 * This is LoanRequest model for the table loan_requests
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class LoanRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'loan_term',
        'state',
        'state_updated_at',
        'amount'
    ];

    /**
     * Get the User record of the LoanRequest.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the LoanDetail record associated with the LoanRequest.
     *
     */
    public function loanDetail()
    {
        return $this->hasOne('App\LoanDetail');
    }

    /**
     * Return the status value of an instance
     *
     * @return string
     */
    public function getLoanStatus()
    {
        return Config::get('loan_states.' . $this->state);
    }

    /**
     * Return the loan type value of an instance
     *
     * @return string
     */
    public function getLoanType()
    {
        return Config::get('loan_types.' . $this->type);
    }
}