<?php

namespace AhrimFakhriy\LivewireDatagrid\Http\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

abstract class LivewireDatagrid extends Component
{
    public string $pageName = 'page';
    public bool $shadow = false;
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

    public function getColumnsProperty(): array
    {
        return $this->columns();
    }

    final public function render(): View
    {
        return $this->view();
    }

}
