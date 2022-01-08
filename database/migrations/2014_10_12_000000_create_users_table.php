<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('name',50);
          $table->string('phone',20);
          $table->string('address',50);
          $table->string('email')->unique();
          $table->string('facebook')->nullable();
          $table->date('birthdate');
          $table->string('password');

          $table->timestamp('email_verified_at')->nullable();
          $table->rememberToken();
          
          $table->softDeletes();
          $table->timestamps();
      });

      
      DB::table('users')->insert([
        [
          'name' => 'user1',
          'password' => bcrypt('12345678'),
          'email' => 'user1@admin.com',
          'phone' => '0999999999',
          'address' => 'fdklsj;afslkj',
          'facebook' => 'user1/facebook',
          'birthdate' => '2021-08-18',
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
        Schema::dropIfExists('users');
    }
}
