<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateClientesTable.
 */
class CreateClientesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->bigInteger('rg')->nullable();
            $table->bigInteger('cpf')->nullable()->unique();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->integer('iduf')->unsigned();
            $table->foreign('iduf')->references('id')->on('estados');
            $table->integer('idmunicipio')->unsigned();
            $table->foreign('idmunicipio')->references('id')->on('municipios');
            $table->integer('ddd_res')->nullable();
            $table->integer('tel_res')->nullable();
            $table->integer('ddd_cel')->nullable();
            $table->integer('tel_cel')->nullable();
            $table->integer('ddd_out')->nullable();
            $table->integer('tel_out')->nullable();
            $table->string('contato')->nullable();
            $table->string('email')->nullable()->unique();
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
		Schema::drop('clientes');
	}
}
