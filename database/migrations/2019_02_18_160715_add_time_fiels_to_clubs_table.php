<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeFielsToClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->string('mo')->nullable();
            $table->string('tu')->nullable();
            $table->string('we')->nullable();
            $table->string('th')->nullable();
            $table->string('fr')->nullable();
            $table->string('sa')->nullable();
            $table->string('su')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->dropColumn('mo');
            $table->dropColumn('tu');
            $table->dropColumn('we');
            $table->dropColumn('th');
            $table->dropColumn('fr');
            $table->dropColumn('sa');
            $table->dropColumn('su');
        });
    }
}
