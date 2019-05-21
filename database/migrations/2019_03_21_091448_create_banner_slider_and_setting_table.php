<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerSliderAndSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $file = base_path('database\sql\banner_and_settings.sql');
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents($file));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
        Schema::dropIfExists('banner_slider');
        Schema::dropIfExists('slider');
        Schema::dropIfExists('settings_website');
    }
}
