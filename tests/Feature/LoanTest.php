<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;
use Tests\Traits\LoanTrait;
use Tests\Traits\UserTrait;

class LoanTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    use UserTrait, LoanTrait;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var User
     */
    protected $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\WeekDaysTableSeeder::class);

        $this->createUser();
        $this->createAdmin();
    }

    /**
     * Test apply-loan end-point
     *
     * @return void
     */
    public function testApplyLoan()
    {
        $api_token = $this->apiToken($this->user);
        $response = $this->post(
            'api/apply-loan?api_token=' . $api_token,
            [
                'type' => 'p',
                'loan_term' => 60,
                'amount' => 50000
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test approve-loan end-point
     */
    public function testApproveLoan()
    {
        $api_token = $this->apiToken($this->admin);
        $response = $this->post(
            'api/approve-loan?api_token=' . $api_token,
            [
                'loan_request_id' => $this->createLoanRequest($this->user)->id
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * Test approve-loan end-point
     */
    public function testRepayLoan()
    {
        $loan_request = $this->createLoanRequest($this->user);
        $api_token = $this->apiToken($this->user);
        $response = $this->post(
            'api/repay-loan?api_token=' . $api_token,
            [
                'loan_id' => $this->approveLoan($loan_request)->id
            ]
        );

        $response->assertStatus(201);
    }
}
