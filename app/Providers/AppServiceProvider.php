<?php

namespace App\Providers;

use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PatientRepositoryInterface;
use App\Repositories\AddressRepository;
use App\Repositories\PatientRepository;
use Illuminate\Support\ServiceProvider;
use App\Jobs\PatientsCsvProcess;
use App\Services\CreatePatientService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {}
}
