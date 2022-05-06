<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('ip');
            $table->string('order_no')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->integer('mobile');
            $table->integer('alt_mobile')->nullable();
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_country');
            $table->integer('billing_pin');
            $table->float('amount');
            $table->float('disc_amount')->nullable();
            $table->integer('coupon_code_id')->nullable();
            $table->integer('final_amount');
            $table->string('payment_method')->nullable();
            $table->string('is_paid')->nullable();
            $table->string('status')->default('1')->comment('1 = new, 2 = confirm, 0 = shipped, 0 = delivered, 0 = cancel');
            $table->integer('service_id')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}