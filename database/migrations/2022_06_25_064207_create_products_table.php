<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('type')->nullable();
            $table->string('part_number')->nullable();
            $table->string('brand')->nullable();
            $table->text('description')->nullable();
            $table->text('part_description')->nullable();
            $table->string('price')->nullable();
            $table->float('commission')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
