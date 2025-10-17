<x-layout>
    @isset($header)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            {{ $header }}
        </div>
    @endisset
    {{ $slot }}
</x-layout>

