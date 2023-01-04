<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->date('date');
            $table->string('store_id')->nullable();
            $table->string('signature_key')->nullable();
            $table->integer('tran_id')->nullable();
            $table->string('success_url')->nullable();
            $table->string('fail_url')->nullable();
            $table->string('cancel_url')->nullable();
            $table->string('amount');
            $table->string('currency');
            $table->string('desc');
            $table->string('cus_name');
            $table->string('cus_email');
            $table->string('cus_add1');
            $table->string('cus_add2');
            $table->string('cus_city');
            $table->string('cus_state');
            $table->string('cus_country');
            $table->string('cus_phone');
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
        Schema::dropIfExists('pays');
    }
};
