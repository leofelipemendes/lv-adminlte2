<?php

use Illuminate\Database\Seeder;

class TipoContaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Entities\TipoConta::create([
            'nome'      => 'Conta Corrente',
            'descricao' =>'Conta Corrente'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Cartão de Credito',
            'descricao' =>'Cartão de Credito'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Aplicação Automatica',
            'descricao' =>'Aplicação Automatica'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Investimento',
            'descricao' =>'Investimento'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Conta Poupança',
            'descricao' =>'Conta Poupança'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Meios de Pagamento',
            'descricao' =>'Meios de Pagamento'
        ]);
        
        App\Entities\TipoConta::create([
            'nome'      => 'Caixinha',
            'descricao' =>'Caixinha'
        ]);
        
    }
}
