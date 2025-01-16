@props(['scheduledConference', 'header' => 'h2'])
<div class="scheduled-conference-summary sm:flex gap-4 bg-[#A294F9]">
    @if($scheduledConference->hasThumbnail())
    <div class="cover max-w-40">
        <img src="{{ $scheduledConference->getThumbnailUrl() }}" alt="{{ $scheduledConference->title }}">
    </div>
    @endif
    <div class="flex-1 space-y-2 information">
        @if ($scheduledConference->date_start)
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <x-heroicon-c-calendar-days class="w-5 h-5" />
                <span>
                    {{ $scheduledConference->date_start?->format(Setting::get('format_date')) }}
                </span>
            </div>
        @endif

        <{{ $header }} class="">
            <a href="{{ $scheduledConference->getHomeUrl() }}"
                class="font-bold serie-name link link-primary link-hover">{{ $scheduledConference->title }}</a>
        </{{ $header }}>

        @if ($scheduledConference->getMeta('description'))
            <p class="text-sm serie-description">{{ $scheduledConference->getMeta('description') }}</p>
        @endif

        <a href="{{ $scheduledConference->getHomeUrl() }}" class="btn btn-primary btn-sm">Check Conference</a>
    </div>
</div>
