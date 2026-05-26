<div
    {{ $attributes->merge($getExtraAttributes())->class(['curator-grid-column relative w-full rounded-t-xl overflow-hidden aspect-square']) }}
>
    @php
        $record = $getRecord();
    @endphp

    <div class="rounded-t-xl h-full overflow-hidden bg-gray-100 dark:bg-gray-950/50">
        @if (str($record->type)->contains('image'))
            <img
                src="{{ $record->medium_url }}"
                alt="{{ $record->alt }}"
                @class([
                    'h-full',
                    'w-auto mx-auto' => str($record->type)->contains('svg'),
                    'object-cover w-full' => ! str($record->type)->contains('svg'),
                ])
            />
        @else
            <x-curator::document-image
                :label="$record->name"
                icon-size="lg"
                :type="$record->type"
                :extension="$record->ext"
            />
        @endif
        <div
            class="absolute inset-x-0 bottom-0 flex items-center justify-between px-2 pt-16 pb-2 text-xs text-white bg-gradient-to-t from-black via-black/80 to-transparent gap-3"
        >
            <p class="truncate font-semibold drop-shadow-md">{{ $record->pretty_name }}</p>
            <p class="flex-shrink-0">{{ $record->size_for_humans }}</p>
        </div>
    </div>
</div>
