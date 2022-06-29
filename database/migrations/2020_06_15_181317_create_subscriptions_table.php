<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {


            $table->increments('id');
            $table->integer('subscription_status')->default(0);
            $table->timestamp('expiration')->nullable();
            $table->text('amount');
            $table->text('phone_number');
            $table->text('package_type');
            $table->timestamp('time_of_payment')->nullable();
            $table->integer('user_id');
            $table->text('transaction_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
