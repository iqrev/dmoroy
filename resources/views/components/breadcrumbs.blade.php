@props(['items'])

<nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="/" class="hover:text-brand-brown transition-colors flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
        </li>
        @foreach($items as $item)
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </li>
            @if($loop->last)
                <li class="text-gray-900 font-medium truncate max-w-[200px] sm:max-w-xs">{{ $item['label'] }}</li>
            @else
                <li>
                    <a href="{{ $item['url'] }}" class="hover:text-brand-brown transition-colors">{{ $item['label'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
