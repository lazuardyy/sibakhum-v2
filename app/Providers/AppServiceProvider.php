<?php

namespace App\Providers;

use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\ButtonRef;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
      $charts->register([
        \App\Charts\FakultasChart::class
      ]);

      config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
      date_default_timezone_set('Asia/Jakarta');
    }
}
