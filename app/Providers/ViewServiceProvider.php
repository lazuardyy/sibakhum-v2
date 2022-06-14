<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\HomeComposer;
use App\View\Composers\PengajuanComposer;
use App\View\Composers\VerifikasiComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('*', HomeComposer::class);
      View::composer(['pengajuan.*',],PengajuanComposer::class);
      View::composer(['verifikasi.*', 'home.index'], VerifikasiComposer::class);
    }
}
