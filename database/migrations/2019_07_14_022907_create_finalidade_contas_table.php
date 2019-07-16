<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFinalidadeContasTable.
 */
class CreateFinalidadeContasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('finalidade_contas', function(Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->string('descricao');
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
		Schema::drop('finalidade_contas');
	}
}
