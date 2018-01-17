<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('quantity');
			$table->integer('price');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
