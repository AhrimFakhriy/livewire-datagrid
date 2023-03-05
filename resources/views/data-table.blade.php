<div class="flex flex-col space-y-6 w-full">
    <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-end">
        <div class="space-y-2 mt-4 sm:mt-0">
            {{-- WithSelect --}}
            {{-- Exportable --}}
            {{-- LeftToolbarView --}}
        </div>
        <div class="grid grid-flow-col sm:auto-cols-max justify-center gap-2">
            {{-- <x-data-table.per-page-input /> --}}
            {{-- <x-data-table.search-input /> --}}
            {{-- RightToolbarView --}}
            {{-- AddButton --}}
            @isset($addButton)
                {!! is_string($addButton) ? $addButton : $addButton->render() !!}
            @endisset
        </div>
    </div>

    <div class="bg-white rounded border border-slate-200"> <!-- shadow-lg goes here if exists !-->
        <div class="overflow-x-auto overflow-y-visible">
            <table class="table-auto w-full border-collapse">
                <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                    <x-livewire-datagrid::table.row>
                        {{-- WithSelect --}}
                        {{-- RowIndex --}}
                        @foreach ($columns as $field => $column)
                            {{-- Sortable --}}
                            <x-livewire-datagrid::table.heading :class="$column['class'] ?? ''">
                                {{ $column['label'] ?? $column }}
                            </x-livewire-datagrid::table.heading>
                        @endforeach
                        {{-- Action --}}
                    </x-livewire-datagrid::table.row>
                </thead>

                <tbody class="text-sm divide-y divide-slate-200">
                    @forelse ($rows as $row)
                        <x-livewire-datagrid::table.row wire:loading.class.delay="opacity-50" wire:key="data-table-row-{{ $row->{$rowIdentifier} }}">
                            {{-- @isset($withSelect)
                                <x-table.cell>
                                    <x-input.checkbox wire:model="selected" :value="$row->{$rowIdentifier}" wire:loading.attr="disabled" />
                                </x-table.cell>
                            @endif --}}
                            {{-- @if ($withRowIndex)
                                <x-table.cell>
                                    <span>{{ $rows?->currentPage() * $rows?->perPage() - $rows?->perPage() + $loop->iteration }}</span>
                                </x-table.cell>
                            @endif --}}
                            @foreach ($columns as $field => $column)
                                <x-livewire-datagrid::table.cell class="px-4 py-3 {{ $column['data-class'] ?? '' }}">
                                    <span>{!!
                                        array_key_exists('formatted_data', $column) && is_callable($column['formatted_data'])
                                            ? $column['formatted_data']($row)
                                            : (! array_key_exists('data', $column)
                                                ? Arr::get($row, $field)
                                                : (! is_callable($column['data'])
                                                    ? Arr::get($row, $column['data'])
                                                    : $column['data']($row)))
                                    !!}</span>
                                </x-livewire-datagrid::table.cell>
                            @endforeach
                            {{-- @isset($actionsView)
                                <x-table.cell>
                                    @include($actionsView, ['row' => $row])
                                </x-table.cell>
                            @endisset --}}
                        </x-livewire-datagrid::table.row>
                    @empty
                        <x-livewire-datagrid::table.row>
                            <x-livewire-datagrid::table.cell colspan="100">
                                <div class="py-2 text-center"><span class="text-slate-500">{{ trans("livewire-datagrid::datatable.labels.no_data") }}</span></div>
                            </x-livewire-datagrid::table.cell>
                        </x-table.row>
                    @endforelse
                </tbody>

                <tfoot class="text-xs border-t border-slate-200 bg-slate-50">
                    {{-- {{ $footer }} --}}
                </tfoot>
            </table>
        </div>
    </div>
    @if ($rows?->links()?->paginator?->hasPages())
        {{ $rows->onEachSide(1)->links() }}
    @endif
</div>
