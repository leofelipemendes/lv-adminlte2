<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContasBancariasTable.
 */
class CreateContasBancariasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('contas_bancarias', function(Blueprint $table) {
                $table->increments('id');
                $table->string('descricao');
                $table->integer('idbanco')->unsigned();
                $table->foreign('idbanco')->references('id')->on('bancos');
                $table->integer('agencia');
                $table->integer('dig_ag');
                $table->integer('nr_conta');
                $table->integer('dig_conta');
                
                $table->integer('tipo_conta')->references('id')->on('tipo_contas');
                $table->integer('finalidade');
                $table->boolean('ativo');
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
		Schema::drop('contas_bancarias');
	}
}
