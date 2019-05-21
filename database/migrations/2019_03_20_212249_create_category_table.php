<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('cat_id');
            $table->string('cat_name');
            $table->string('cat_rewrite');
            $table->string('cat_type')->nullable();
            $table->integer('cat_parent_id');
            $table->tinyInteger('cat_active')->default(0);
            $table->string('cat_seo_title')->nullable();
            $table->string('cat_seo_keyword')->nullable();
            $table->text('cat_seo_description')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
