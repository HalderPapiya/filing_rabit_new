<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_usage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('coupon_code_id');
            $table->string('coupon_code');
            $table->float('discount')->nullable();
            $table->float('total_checkout_amount');
            $table->float('final_amount');
            $table->integer('user_id');
            $table->string('email')->nullable();
            $table->string('user_ip')->nullable();
            $table->float('order_id')->nullable();
            $table->time('usage_time')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 = Active, 0 = Inactive');
            $table->softDeletes();
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
        Schema::dropIfExists('coupon_usage');
    }
}
