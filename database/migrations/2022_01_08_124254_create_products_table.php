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
            $table->string('name_ar', 50);
            $table->string('name_en', 50);
            $table->string('image')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('price');
            $table->double('price_after_discount')->nullable();
            $table->date('production_date')->nullable();
            $table->date('expired_date');
            $table->boolean('is_expired')->default(false);
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('category_id')->references('id')->on('categories');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('products')->insert([
        [
          'name_ar' => 'منتج1',
          'name_en' => 'product1',

          'quantity' => '5',
          'price' => '1000',
          'price_after_discount' => '100',
          'production_date' => '2021-08-18',
          'expired_date' => '2021-09-18',
          
          'user_id' => '1',
          'category_id' => '1',
        ]
      ]);
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
