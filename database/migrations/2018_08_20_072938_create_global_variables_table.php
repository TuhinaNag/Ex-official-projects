<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('var_name');
            $table->string('chatfuelBotId')->nullable();
            $table->string('currentVal');   
            $table->string('initialVal');  
            $table->string('defaultVal');
            $table->enum('dataType', ['1', '2', '3', '4', '5'])->comment = "1=>int,2=>decimal,3=>string,4=>date,5=>timestamp";  
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
        Schema::dropIfExists('global_variables');
    }
}
