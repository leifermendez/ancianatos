<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->string('address');
            $table->string('emergency_name')->nullable();
            $table->string('emergency_last_name')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->longText('description')->nullable();
            $table->longText('images')->nullable();
            $table->integer('age')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('institutions_id')->unsigned();
            $table->string('email');
            $table->longText('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
