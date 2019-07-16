<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_contas')->delete();
        DB::table('finalidade_contas')->delete();
        
        $this->call([
        TipoContaTableSeeder::class,
        FinalidadeContasTableSeeder::class,
//        EstadoTableSeeder::class,
//        MunicipiosTableSeeder::class,
        ]);
// $this->call(UsersTableSeeder::class);
    }
}
