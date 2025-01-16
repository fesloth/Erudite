@props([
    'title' => null,
])
<x-website::layouts.base :title="$title">
    <div class="flex flex-col h-full min-h-screen">
        @hook('Frontend::Views::Header')

        {{-- Load Header Layout --}}
        <x-website::layouts.header />

        <main class="py-3">
            {{-- Load Main Layout --}}
            {{ $slot }}
        </main>

        {{-- Load Footer Layout --}}
        <x-website::layouts.footer />

        @hook('Frontend::Views::Footer')
    </div>
</x-website::layouts.base>
