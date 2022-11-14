<?php

namespace AhrimFakhriy\LivewireDatagrid\Concerns;

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

    public function resetFilters(): void
    {
        $this->reset('filters');
    }

    public function resetSearch(): void
    {
        $this->filters['search'] = null;
    }
}
