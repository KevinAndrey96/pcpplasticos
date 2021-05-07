<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->increments('id');
            $table->string('seller_role');
            $table->string('status');
            $table->string('buyer_role');
            $table->string('currency');
            $table->double('total');
            $table->text('coment')->nullable();
            $table->string('delivery_address');
            $table->timestamps();   
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('buyer_id');
            
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
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

/*
Schema::table('brands', function (Blueprint $table) {
    $table->string('url_logo', 255)->nullable()->after('name');
    $table->string('color', 10)->nullable()->after('url_logo');
    $table->unsignedInteger('company_id')->nullable()->after('color');
    $table->foreign('company_id')->references('id')->on('companies');
});
*/