<nav class="text-sm text-gray-400 mb-4">
    @foreach ($links as $link)
        @if(isset($link['url']))
            <a href="{{ $link['url'] }}" class="hover:text-white">
                {{ $link['name'] }}
            </a>
            <span class="mx-2">></span>
        @else
            <span class="text-white font-semibold">
                {{ $link['name'] }}
            </span>
        @endif
    @endforeach
</nav>