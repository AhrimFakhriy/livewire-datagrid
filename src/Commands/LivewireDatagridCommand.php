<?php

namespace AhrimFakhriy\LivewireDatagrid\Commands;

use Illuminate\Console\Command;

class LivewireDatagridCommand extends Command
{
    public $signature = 'livewire-datagrid';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
