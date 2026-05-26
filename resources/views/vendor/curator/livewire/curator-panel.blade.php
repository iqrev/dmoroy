<div
    x-data="{
        selected: $wire.entangle('selected'),
        multiple: {{ $isMultiple ? 'true' : 'false' }},
        handleItemClick: function (media = null) {
            if (! media) return;

            if (this.isSelected(media.id)) {
                this.removeFromSelection(media.id);
                return;
            }

            if (! this.multiple) {
                this.selected = [];
            }

            this.addToSelection(media);
        },
        hasSelection: function () {
            return this.selected.length > 0;
        },
        isSelected: function (id = null) {
            if (! this.hasSelection()) return false;

            return this.selected.find(function (item) {
                return item.id == id;
            }) !== undefined;
        },
        addToSelection: function (media = null) {
            if (! media) return;

            this.selected.push(media);
        },
        removeFromSelection: function (id = null) {
            if (! id) return;

            this.selected = this.selected.filter(function (item) {
                return item.id != id;
            });
        },
    }"
    class="curator-panel h-full absolute inset-0 flex flex-col"
>
    <!-- Controls -->
    <div
        x-show="hasSelection()"
        class="curator-panel-controls fixed bottom-0 md:bottom-auto md:top-4 inset-x-0 pointer-events-none transition z-20 flex justify-center"
        x-transition:enter="ease-out duration-100"
        x-transition:enter-start="opacity-0 translate-y-0 md:-translate-y-4"
        x-transition:enter-end="opacity-100 -translate-y-4 md:translate-y-0"
        x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100 -translate-y-4 md:translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-0 md:-translate-y-4"
        x-cloak
    >
        <div class="bg-black md:bg-gray-800 md:rounded-xl p-3 w-full md:w-auto flex items-center gap-3 pointer-events-auto">
            {{ $this->insertMedia }}
            <x-filament::button
                color="gray"
                size="sm"
                x-on:click="selected = []"
            >
                {{ trans('curator::views.panel.deselect_all') }}
            </x-filament::button>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="curator-panel-toolbar px-4 py-2 flex items-center justify-between bg-gray-200/70 dark:bg-black/20 dark:text-white border-b border-gray-300 dark:border-gray-800">
        <div class="flex items-center gap-2">
            <h3 class="font-bold text-lg hidden md:block">Media Library</h3>
        </div>
        <div class="flex items-center gap-4">
            <label class="shrink-0 border border-gray-300 dark:border-gray-700 rounded-md relative flex items-center">
                <span class="sr-only">{{ trans('curator::views.panel.search_label') }}</span>
                <x-filament::input.wrapper
                    prefix-icon="heroicon-s-magnifying-glass"
                    prefix-icon-alias="curator::icons.search"
                >
                    <x-filament::input
                        type="search"
                        placeholder="{{ trans('curator::views.panel.search_placeholder') }}"
                        wire:model.live.debounce.500ms="search"
                    />
                </x-filament::input.wrapper>
                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="animate-spin h-4 w-4 text-gray-400 dark:text-gray-500 sm absolute right-2 z-10" wire:loading.delay wire:target="search">
                    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
            </label>
            <x-filament::icon-button
                x-on:click="close()"
                icon="heroicon-o-x-mark"
                color="gray"
            />
        </div>
    </div>
    <!-- End Toolbar -->

    <div class="flex-1 relative flex flex-col overflow-hidden dark:bg-gray-950/30">
        <!-- Top Section: Upload Area & Selected Files -->
        <div class="w-full bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-800 p-4">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Upload Form -->
                <div class="flex-1">
                    <h4 class="font-bold mb-2">
                        {{ trans('curator::views.panel.add_files') }}
                    </h4>

                    <div class="flex items-center pb-2 justify-start gap-2">
                        @if ( $this->addFilesAction->isVisible())
                            {{ $this->addFilesAction }}
                            {{ $this->addInsertFilesAction }}
                        @endif
                    </div>

                    <div class="mt-px">
                        {{ $this->form }}
                    </div>
                </div>

                <!-- Selected Files -->
                <div class="lg:w-1/3 flex flex-col" x-show="hasSelection()">
                    <h4 class="font-bold mb-2">
                        Selected Files
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="media in selected" :key="media.id">
                            <div class="w-12 h-12 rounded overflow-hidden relative group">
                                <img
                                    x-bind:src="media.url"
                                    class="w-full h-full object-cover object-center rounded"
                                    x-bind:alt="media.alt"
                                />
                                <button
                                    type="button"
                                    class="opacity-0 bg-danger-500 w-full h-full grid place-content-center group-hover:opacity-100 absolute inset-0"
                                    x-on:click="removeFromSelection(media.id)"
                                >
                                    <x-filament::icon
                                        alias="curator::icons.remove"
                                        icon="heroicon-s-x-mark"
                                        class="w-5 h-5 text-white"
                                    />
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="curator-panel-gallery flex-1 h-full overflow-auto p-4 bg-slate-50 dark:bg-slate-50">
            <ul @class([
                'text-sm flex items-center flex-wrap gap-1.5 text-slate-600 font-medium',
                'mb-4' => filled($breadcrumbs),
            ])>
                @if ($breadcrumbs)
                    @foreach($breadcrumbs as $breadcrumb)
                        <li wire:key="breadcrumb-{{ $breadcrumb['path'] }}" class="flex items-center gap-1.5">
                            @if ($loop->first)
                                <x-filament::icon
                                    alias="curator::icons.disk"
                                    icon="heroicon-m-circle-stack"
                                    class="w-4 h-4 text-slate-400"
                                />
                            @endif
                            
                            @if ($loop->last)
                                <span class="text-slate-800 font-bold px-1.5 py-0.5 rounded bg-slate-200/60">{{ $breadcrumb['label'] }}</span>
                            @else
                                <button
                                    type="button"
                                    wire:click.prevent="handleDirectoryChange('{{ $breadcrumb['path'] }}')"
                                    class="text-primary-600 hover:text-primary-800 hover:underline transition font-semibold"
                                >
                                    {{ $breadcrumb['label'] }}
                                </button>
                                <span class="text-slate-400">/</span>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="curator-picker-grid">
                @if ($subDirectories)
                    @foreach($subDirectories as $dir)
                        <li
                            wire:key="dir-{{ $dir['name'] }}" class="relative aspect-square"
                        >
                            <button
                                type="button"
                                wire:click="handleDirectoryChange('{{ $dir['path'] }}')"
                                class="block w-full h-full overflow-hidden bg-white border border-slate-200 rounded-xl hover:text-primary-600 hover:bg-primary-50/50 hover:border-primary-300 hover:ring-2 hover:ring-primary-500/20 focus:text-primary-600 focus:bg-primary-50/50 focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 shadow-sm"
                            >
                                <div class="grid place-content-center place-items-center w-full h-full text-xs relative text-slate-700">
                                    <x-filament::icon
                                        alias="curator::icons.folder"
                                        icon="heroicon-s-folder"
                                        class="w-14 h-14 text-amber-500 mb-1"
                                    />
                                    <span class="font-semibold text-slate-800">{{ $dir['label'] }}</span>
                                </div>
                            </button>
                        </li>
                    @endforeach
                @endif
                @forelse ($files as $file)
                    <li
                        wire:key="media-{{ $file['id'] }}"
                        class="relative aspect-square group"
                    >
                        <button
                            type="button"
                            x-on:click="handleItemClick(@js($file))"
                            @class([
                              'block w-full h-full overflow-hidden bg-gray-700 rounded-md checkered',
                              'p-2' => curator()->isSvg($file['ext']),
                            ])
                        >
                            <x-curator::display
                                :item="$file"
                                :src="$file['thumbnail_url']"
                                :alt="$file['alt'] ?? ''"
                                icon-classes="size-12"
                                width="200"
                                height="200"
                            />
                        </button>

                        <button
                            type="button"
                            x-on:click="removeFromSelection({{ $file['id']}})"
                            x-show="isSelected('{{ $file['id'] }}')"
                            x-cloak
                            class="absolute inset-0 flex items-center justify-center w-full h-full rounded-md shadow text-primary-600 bg-primary-500/20 ring-2 ring-primary-500"
                        >
                            <span class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary-500 drop-shadow">
                                <x-filament::icon
                                    alias="curator::icons.check"
                                    icon="heroicon-s-check"
                                    class="w-5 h-5"
                                />
                            </span>
                            <span class="sr-only">
                                {{ trans('curator::views.panel.deselect') }}
                            </span>
                        </button>

                        <div
                            class="absolute top-1 right-1 flex justify-center shadow-md rounded bg-gray-800 opacity-0 pointer-events-none transition group-hover:opacity-100 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:pointer-events-auto"
                        >
                            <div class="flex items-center justify-center w-8 h-8">
                                <x-filament-actions::group
                                    :actions="[
                                        ($this->viewItemAction)(['item' => $file]),
                                        ($this->downloadItemAction)(['item' => $file]),
                                        ($this->editItemAction)(['item' => $file]),
                                        ($this->destroyItemAction)(['item' => $file]),
                                    ]"
                                    color="primary"
                                    icon-size="sm"
                                    dropdown-placement="bottom-start"
                                    dropdown-width="max-w-48"
                                />
                            </div>
                        </div>

                        <p
                            class="text-xs truncate absolute bottom-0 inset-x-0 px-1 pb-1 pt-4 rounded-b text-white bg-gradient-to-t from-black/80 to-transparent pointer-events-none opacity-0 transition group-hover:opacity-100 group-focus-within:opacity-100"
                        >
                            {{ $file['pretty_name'] }}
                        </p>
                    </li>
                @empty
                    @empty($subDirectories)
                        <li class="col-span-3 sm:col-span-4 md:col-span-6 lg:col-span-8 text-center py-12 text-slate-500 font-medium">
                            {{ trans('curator::views.panel.empty') }}
                        </li>
                    @endempty
                @endforelse
            </ul>

            @if($currentPage < $lastPage)
            <div class="flex justify-center py-8 mt-6 border-t border-gray-200 dark:border-gray-800" aria-live="polite">
                <x-filament::button
                    color="gray"
                    wire:click="loadMoreFiles()"
                    wire:loading.attr="disabled"
                    wire:target="loadMoreFiles"
                    aria-label="{{ trans('curator::views.panel.load_more') }}"
                    class="w-full sm:w-auto min-w-[200px]"
                >
                    <span wire:loading.remove wire:target="loadMoreFiles" class="font-semibold text-sm">
                        {{ trans('curator::views.panel.load_more') }}
                    </span>
                    <span wire:loading wire:target="loadMoreFiles" class="font-semibold text-sm flex items-center gap-2">
                        <x-filament::loading-indicator class="w-4 h-4" />
                        Memuat data...
                    </span>
                </x-filament::button>
            </div>
            @endif
        </div>
        <!-- End Gallery -->
        <x-filament-actions::modals />
    </div>
</div>
