<?php

use Illuminate\Database\Seeder;
use App\Entities\Municipio;
class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipio::create([
            'codigo' => 1,
            'nome'=> 'SP',
            'uf' => 'SP',
            'iduf' => 1
        ]);
    }
}
