@props([
    'sortable' => false,
    'direction' => null,
])

<th {{ $attributes->merge(['class' => 'px-4 py-3 whitespace-nowrap first:rounded-tl last:rounded-tr text-slate-500 font-semibold text-left']) }}>
    @unless($sortable)
        <span>{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }} class="flex items-center space-x-1 text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider group focus:outline-none hover:underline">
            <span>{{ $slot }}</span>

            <span class="relative flex items-center">
                @if ($direction === 'asc')
                    <svg class="w-4 h-4 fill-transparent stroke-current stroke-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                @elseif ($direction === 'desc')
                    <svg class="w-4 h-4 fill-transparent stroke-current stroke-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path></svg>
                @endif
            </span>
        </button>
    @endunless
</th>
