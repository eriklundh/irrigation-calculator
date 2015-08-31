<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->string('crop', 255);
            $table->string('soil', 255);
            $table->string('efficiency', 255);
            $table->string('model', 255);
            $table->string('kml', 255);
            $table->string('channelConnex', 255);
            $table->string('connectivity', 255);
            $table->string('output', 255);
            $table->string('state', 255);
            $table->dateTime('crop_at');
            $table->dateTime('soil_at');
            $table->dateTime('efficiency_at');
            $table->dateTime('model_at');
            $table->dateTime('kml_at');
            $table->dateTime('channelConnex_at');
            $table->dateTime('connectivity_at');
            $table->dateTime('output_at');
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
        Schema::drop('uploads');
    }
}
