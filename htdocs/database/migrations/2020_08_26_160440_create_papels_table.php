<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papeis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->timestamps();
        });
        Schema::create('papel_permissao', function (Blueprint $table) {
            $table->integer('permissaoid');
            $table->integer('papelid');
            //$table->foreign('permissaoid')->references('id')->on('permissoes')->onDelete('cascade');
            //$table->foreign('papelid')->references('id')->on('papel')->onDelete('cascade');
            $table->primary(['permissaoid', 'papelid']);
        });
        Schema::create('papel_user', function (Blueprint $table) {
            $table->integer('userid');
            $table->integer('papelid');
            //$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('papelid')->references('id')->on('papel')->onDelete('cascade');
            $table->primary(['userid', 'papelid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papel_user');
        Schema::dropIfExists('papel_permissao');
        Schema::dropIfExists('papeis');
    }
}
