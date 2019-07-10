<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFornecedorsTable.
 */
class CreateFornecedorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fornecedores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomefantasia');
            $table->string('razaosocial');
            $table->biginteger('cnpj');
            $table->integer('iduf')->unsigned();
            $table->foreign('iduf')->references('id')->on('estados');
            $table->integer('idmunicipio')->unsigned();
            $table->foreign('idmunicipio')->references('id')->on('municipios');
            $table->biginteger('ie')->nullable();
            $table->biginteger('im')->nullable();
            $table->boolean('matriz')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('contato')->nullable();
            $table->string('tel_contato')->nullable();
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
		Schema::drop('fornecedores');
	}
}
