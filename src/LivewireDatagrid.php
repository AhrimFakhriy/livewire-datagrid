<?php

namespace AhrimFakhriy\LivewireDatagrid;

use AhrimFakhriy\LivewireDatagrid\Traits\WithFilters;
use AhrimFakhriy\LivewireDatagrid\Traits\WithSelect;
use AhrimFakhriy\LivewireDatagrid\Traits\WithSorting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\{Component, WithPagination};

abstract class LivewireDatagrid extends Component
{
    use WithPagination, WithSorting, WithFilters, WithSelect;

    public string $rowIdentifier = 'id';
    public string $pageName = 'page';
    public int $perPage = 10;

    public abstract function query(): Builder;
    public abstract function columns(): array;

    public function rowsQuery(): Builder
    {
        return $this->applySorting($this->query());
    }

    public function rows(): LengthAwarePaginator
    {
        $rows = $this->rowsQuery()->paginate(perPage: $this->perPage, pageName: $this->pageName);

        if (method_exists($this, 'transform'))
            tap($rows, fn (LengthAwarePaginator $rows) => $rows->transform([$this, 'transform']));

        return $rows;
    }

    public function getRowsProperty(): LengthAwarePaginator
    {
        return $this->rows();
    }

    public function getRowIdentifiersProperty(): Collection
    {
        return $this->rows
            ->pluck($this->rowIdentifier)
            ->map(fn ($id) => (string) $id);
    }

    public function getColumnsProperty(): array
    {
        return $this->columns();
    }

    public abstract function view(): View;
    public abstract function addButton(): View|array|string;

    final public function render(): View
    {
        return $this->view();
    }

}
