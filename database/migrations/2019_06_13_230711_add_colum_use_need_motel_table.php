<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumUseNeedMotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motelrooms', function (Blueprint $table) {
            $table->tinyInteger('use_need')->default(0)->comment('0: Cho thuê | 1: Ở ghép ...');
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
            $table->dropColumn('use_need');
        });
    }
}
