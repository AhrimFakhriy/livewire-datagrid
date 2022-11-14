<?php

namespace AhrimFakhriy\LivewireDatagrid;

use Illuminate\Support\Facades\Blade;

final class Button
{
    public function __construct(
        public string $target = '_self',
        public ?string $route = null,
        public ?string $label = null,
        public ?string $class = null,
        public ?string $icon = '<svg viewBox="0 0 24 24" class="h-6 w-6 fill-transparent stroke-current stroke-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>',
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

    public function class(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function icon(?string $bladeComponent): self
    {
        $this->icon = $bladeComponent;
        return $this;
    }

    public function render(): string
    {
        $class = 'inline-flex space-x-2 items-center px-4 py-2 border border-transparent focus:border-indigo-800 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-0 disabled:opacity-25 transition ease-in-out duration-150';

        if (! is_null($this->class)) {
            $class .= ' ' . $this->class;
        }

        if (! $this->enabled) {
            $class .= ' pointer-events-none';
        }

        $disabled = !$this->enabled;

        $buttonClass = ($this->icon)
            ? 'hidden md:block whitespace-nowrap'
            : 'whitespace-nowrap';

        return Blade::render(
            "<a class=\"{$class}\" href=\"{$this->route}\" disabled=\"{$disabled}\">
                {$this->icon}
                <span class=\"{$buttonClass}\">
                    $this->label
                </span>
            </a>"
        );
    }


//
}
