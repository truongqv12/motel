<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueMotelroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motelrooms', function (Blueprint $table) {
            $table->dropUnique('motelrooms_title_unique');
            $table->dropUnique('motelrooms_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motelrooms', function (Blueprint $table) {
            $table->unique('title');
            $table->unique('slug');
        });
    }
}
