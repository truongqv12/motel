<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('pos_id');
            $table->string('pos_title');
            $table->string('pos_rewrite');
            $table->string('pos_image');
            $table->text('pos_teaser');
            $table->text('pos_content');
            $table->integer('pos_category_id');
            $table->tinyInteger('pos_active')->default(1);
            $table->tinyInteger('pos_is_hot')->default(0);
            $table->integer('pos_total_view')->default(0);
            $table->string('pos_type')->nullable();
            $table->string('pos_seo_title')->nullable();
            $table->string('pos_seo_keyword')->nullable();
            $table->text('pos_seo_description')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
