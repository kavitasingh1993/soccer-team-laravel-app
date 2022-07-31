<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('playerImageURL');
            $table->timestamps();
            $table->unsignedBigInteger('team_id');
           // $table->bigInteger('team_id')->unsigned()->change();
  
           // $table->foreign('team_id')->references('id')->on('teams');

          //  $table->index('user_id');
          //  $table->foreign('user_id')->references('id')->on('teams')->onDelete('cascade');
           // $table->foreign('team_id')->references('id')->on('teams');
        });

        Schema::table('players', function (Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
