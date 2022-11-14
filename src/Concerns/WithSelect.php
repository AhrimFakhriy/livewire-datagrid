<?php

namespace AhrimFakhriy\LivewireDatagrid\Concerns;

trait WithSelect
{
    public array $selected = [];

    public function pageIsSelected(): bool
    {
        return ($ids = $this->rowIdentifiers)->isNotEmpty()
            ? $ids->diff($this->selected)->isEmpty()
            : false;
    }

    public function selectPage($value): void
    {
        $ids = $this->rowIdentifiers;

        $this->selected = $value
            ? collect($this->selected)->merge($ids)->unique()->toArray()
            : collect($this->selected)->diff($ids)->unique()->toArray();
    }

    public function changeSelection(int $value, bool $checked): void
    {
        $this->selected = ($checked)
            ? collect($this->selected)->push($value)->unique()->toArray()
            : collect($this->selected)->diff($value)->unique()->toArray();
    }

    public function selectAll(): void
    {
        $this->selected = $this->rowsQuery()
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function renderWithSelectData(): array
    {
        return [
            'pageIsSelected'    => $this->pageIsSelected(),
            'selected'          => $this->selected,
            'withSelect'        => true,
        ];
    }
}
