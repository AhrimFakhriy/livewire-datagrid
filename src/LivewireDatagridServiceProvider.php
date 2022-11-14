<?php

namespace AhrimFakhriy\LivewireDatagrid;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AhrimFakhriy\LivewireDatagrid\Commands\LivewireDatagridCommand;

class LivewireDatagridServiceProvider extends PackageServiceProvider
{

    private string $packageName = 'livewire-datagrid';

    public function configurePackage(Package $package): void
    {
        $package
            ->name($this->packageName)
            ->hasConfigFile()
            ->hasViews();
            // ->hasMigration('create_livewire-datagrid_table')
            // ->hasCommand(LivewireDatagridCommand::class);

        $this->publishViews();
        // $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', $this->packageName);
    }

    private function publishViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', $this->packageName);

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/' . $this->packageName),
        ], $this->packageName . '-views');
    }
}
