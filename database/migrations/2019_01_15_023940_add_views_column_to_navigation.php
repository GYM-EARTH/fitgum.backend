<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewsColumnToNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigation', function (Blueprint $table) {
            $table->integer('views')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigation', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
}
