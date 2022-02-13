<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_request_id');
            $table->decimal('sanctioned_amount', 8, 2);
            $table->decimal('interest_rate', 5, 2)->default(10);
            $table->decimal('instalment_amount', 8, 2);
            $table->unsignedSmallInteger('instalment_day_id')->nullable();
            $table->enum('state', ['a', 'c']);
            $table->dateTime('state_updated_at');
            $table->timestamps();

            $table->foreign('loan_request_id')
                ->references('id')->on('loan_requests')
                ->onDelete('cascade');

            $table->foreign('instalment_day_id')
                ->references('id')->on('week_days')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_details');
    }
}
