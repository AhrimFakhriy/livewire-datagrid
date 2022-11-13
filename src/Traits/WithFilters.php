<?php

namespace AhrimFakhriy\LivewireDatagrid\Traits;

trait WithFilters
{
    public array $filters = [];

    public function mountWithFilters(): void
    {
        $this->filters = [
            'search' => null,
            ...$this->filters(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function updatingFilters()
    {
        $this->resetPage($this->pageName);
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
