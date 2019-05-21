<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotelroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motelrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->double('price');
            $table->float('area', 8, 4);
            $table->integer('cty_id');
            $table->integer('dis_id');
            $table->integer('war_id')->default(0);
            $table->string('address');
            $table->string('phone');
            $table->integer('people')->default(1);
            $table->string('toilet')->nullable();
            $table->text('images');
            $table->text('description')->nullable();
            $table->text('amenities')->nullable()->comment('tien nghi');
            $table->integer('category_id');
            $table->integer('use_id')->default(0)->comment('nguoi dang tin');
            $table->string('latlng')->nullable()->comment('Toa do');
            $table->tinyInteger('status')->default(0)->comment('trang thai');
            $table->integer('total_view')->default(0);
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
        Schema::dropIfExists('motelrooms');
    }
}
