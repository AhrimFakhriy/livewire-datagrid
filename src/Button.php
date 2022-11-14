<?php

namespace AhrimFakhriy\LivewireDatagrid;

final class Button
{
    public function __construct(
        public string $target = '_self',
        public ?string $route = null,
        public ?string $label = null,
        public ?string $icon = null,
        public bool $enabled = true,
    ) { }

    public static function make(string $label, ?string $route = null): self
    {
        return (new static(label: $label, route: $route));
    }

    public function enabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function target(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function route(string $route): self
    {
        $this->route = $route;
        return $this;
    }

    public function icon(string $bladeComponent): self
    {
        $this->icon = $bladeComponent;
        return $this;
    }
}
