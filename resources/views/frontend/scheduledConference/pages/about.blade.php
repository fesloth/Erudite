<x-website::layouts.main>
    <div class="mb-6">
        <x-website::breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />
    </div>
    <div class="relative max-w-7xl">
        <div class="flex mb-5 space-x-4">
            <h1 class="text-xl font-semibold min-w-fit">{{ $this->getTitle() }}</h1>
        </div>
        @if ($about)
            <div class="user-content">
                {{ new Illuminate\Support\HtmlString($about) }}
            </div>
        @else
            <div>
                No information provided.
            </div>
        @endif
    </div>
</x-website::layouts.main>
