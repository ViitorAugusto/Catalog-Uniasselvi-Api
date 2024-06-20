<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('slug');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->string('description');
            $table->string('moreDetails', 5000);
            $table->string('category');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

