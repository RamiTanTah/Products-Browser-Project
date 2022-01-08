<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 25)->unique();
            $table->string('name_en', 25)->unique();
            $table->timestamps();
        });

        DB::table('categories')->insert([
        [
          'name_en' => 'cat1',
          'name_ar' => 'نوع1',
        ],
        [
          'name_en' => 'Office Supplies',
          'name_ar' => 'تجهيزات مكتبية',
        ],
        [
          'name_en' => 'School Supplies',
          'name_ar' => 'تجهيزات مدرسية',
        ],
        [
          'name_en' => 'Toys',
          'name_ar' => 'ألعاب',
        ],
        [
          'name_en' => 'Arts & Crafts',
          'name_ar' => 'فنون وهدايا',
        ],
        [
          'name_en' => 'Books',
          'name_ar' => 'كتب',
        ],
        [
          'name_en' => 'Tecnology Equipment',
          'name_ar' => 'أدوات تكنولوجية',
        ],
        [
          'name_en' => 'Cars',
          'name_ar' => 'سيارات',
        ],
        [
          'name_en' => 'Others',
          'name_ar' => 'غير ذلك',
        ],
      ]
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
