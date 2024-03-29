<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\DepartamentoRepository::class, \App\Repositories\DepartamentoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TesteRepository::class, \App\Repositories\TesteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClienteRepository::class, \App\Repositories\ClienteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FornecedorRepository::class, \App\Repositories\FornecedorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EstadoRepository::class, \App\Repositories\EstadoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MunicipioRepository::class, \App\Repositories\MunicipioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoriaRepository::class, \App\Repositories\CategoriaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BancoRepository::class, \App\Repositories\BancoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ContasBancariaRepository::class, \App\Repositories\ContasBancariaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoContaRepository::class, \App\Repositories\TipoContaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FinalidadeContaRepository::class, \App\Repositories\FinalidadeContaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CentroCustoRepository::class, \App\Repositories\CentroCustoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanoContaRepository::class, \App\Repositories\PlanoContaRepositoryEloquent::class);
        //:end-bindings:
    }
}
