<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_values', function (Blueprint $table) {
            $table->id();
            $table->integer('forms_id')->unsigned();
            $table->longText('values');
            $table->integer('target_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->longText('extra')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('forms_values');
    }
}
