@props(['conference', 'header' => 'h2'])

<div class="gap-4 conference-summary sm:flex">
    <div class="cover max-w-40">
        <img src="{{ $conference->getThumbnailUrl() }}" alt="{{ $conference->name }}">
    </div>
    <div class="flex-1 space-y-2 information">
        @if ($conference?->activeSerie?->date_start)
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <x-heroicon-c-calendar-days class="w-5 h-5" />
                <span>
                    {{ $conference?->activeSerie?->date_start?->format(Setting::get('format_date')) }}
                </span>
            </div>
        @endif

        <{{ $header }} class="">
            <a href="{{ $conference->getHomeUrl() }}"
                class="font-bold conference-name link link-primary link-hover">{{ $conference->name }}</a>
            {{-- <span class="badge badge-sm">{{ $conference->type }}</span> --}}
        </{{ $header }}>

        @if ($conference->getMeta('description'))
            <p class="text-sm conference-description line-clamp-4">{{ $conference->getMeta('description') }}</p>
        @endif

        <a href="{{ $conference->getHomeUrl() }}" class="btn btn-primary btn-sm">Check Conference</a>
    </div>
</div>
