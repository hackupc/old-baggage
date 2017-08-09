<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
          $table->char('row', 1);
          $table->smallInteger('col');
          $table->string('id', 25);
          $table->string('name', 50);
          $table->string('surname', 50);
          $table->timestamp('created')->default(\DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('deleted')->nullable()->default(NULL);
          $table->string('description', 250)->nullable()->default(NULL);
          $table->primary(['row', 'col', 'created']);
          $table->unique(['row', 'col', 'deleted']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('positions');
    }
}
