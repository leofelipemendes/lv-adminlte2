<?php

use Illuminate\Database\Seeder;
use \App\Entities\Estado;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'sigla' => 'SP',
            'descricao' => 'SP',
            
        ]);
    }
}
