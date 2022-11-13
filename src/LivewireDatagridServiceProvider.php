<?php

namespace AhrimFakhriy\LivewireDatagrid;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AhrimFakhriy\LivewireDatagrid\Commands\LivewireDatagridCommand;

class LivewireDatagridServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('livewire-datagrid')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_livewire-datagrid_table')
            ->hasCommand(LivewireDatagridCommand::class);
    }
}
