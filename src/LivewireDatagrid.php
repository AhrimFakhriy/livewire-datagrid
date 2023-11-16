<?php

namespace AhrimFakhriy\LivewireDatagrid;

use AhrimFakhriy\LivewireDatagrid\Concerns\WithFilters;
use AhrimFakhriy\LivewireDatagrid\Concerns\WithSorting;
use AhrimFakhriy\LivewireDatagrid\Concerns\WithSelect;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\{Component, WithPagination};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

abstract class LivewireDatagrid extends Component
{
    use WithPagination, WithSorting, WithFilters;

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

    public function getColumnsProperty(): array
    {
        return $this->columns();
    }

    public function getRowIdentifiersProperty(): Collection
    {
        return $this->rows
            ->pluck($this->rowIdentifier)
            ->map(fn ($id) => (string) $id);
    }

    public function addButton(): Button|View|string|null
    {
        return null;
    }

    public function footer(): View|string|null
    {
        return null;
    }

    public function view(): View {
        return view('livewire-datagrid::data-table');
    }

    final public function render(): View
    {
        $withSelect = in_array(WithSelect::class, class_uses_recursive($this))
            ? $this->renderWithSelectData()
            : [];

        return $this->view()->with([
            'addButton' => $this->addButton(),
            'columns' => $this->columns(),
            'footer' => $this->footer(),
            'rows' => $this->rows,
            ...$withSelect,
        ]);
    }
}
