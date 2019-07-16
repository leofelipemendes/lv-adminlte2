<?php

use Illuminate\Database\Seeder;

class FinalidadeContasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Entities\FinalidadeConta::create([
            'nome'      => 'Pessoa Jurídica',
            'descricao' =>'Pessoa Jurídica'
        ]);
        
        App\Entities\FinalidadeConta::create([
            'nome'      => 'Pessoa Fisica',
            'descricao' =>'Pessoa Fisica'
        ]);
    }
}
