<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      						
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('user_name');
            $table->string('phone');
            $table->string('email');
            $table->text('billing_address')->nullable();
            $table->text('shiping_address')->nullable();
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
        Schema::dropIfExists('shippings');
    }
}
