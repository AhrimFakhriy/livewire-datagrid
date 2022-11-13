<?php

namespace AhrimFakhriy\LivewireDatagrid\Traits;

use Illuminate\Contracts\Database\Query\Builder;

trait WithSorting {

    public $sorts = [];

    public function sortBy(string $field)
    {
        if (! array_key_exists('sortable', $this->columns()[$field])) {
            return;
        }

        if (! isset($this->sorts[$field])) {
            return $this->sorts[$field] = 'asc';
        }

        if ($this->sorts[$field] === 'asc') {
            return $this->sorts[$field] = 'desc';
        }

        unset($this->sorts[$field]);
    }

    public function applySorting(Builder $query): Builder
    {
        foreach ($this->sorts as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        return $query;
    }
}
