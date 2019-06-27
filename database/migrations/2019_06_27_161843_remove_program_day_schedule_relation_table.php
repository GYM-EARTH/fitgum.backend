<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveProgramDayScheduleRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('program_day_schedule_relation');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('program_day_schedule_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_day_id');
            $table->integer('program_day_schedule_id');
            $table->timestamps();
        });
    }
}
