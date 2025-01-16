<x-website::layouts.main>
    @if ($conference->hasMedia('cover'))
        <div class="conference-cover>
            <img class="h-full" src="{{ $conference->getFirstMedia('cover')->getAvailableUrl(['thumb', 'thumb-xl']) }}"
                alt="{{ $conference->title }}" />
        </div>
    @endif
    @if ($conference->getMeta('about'))
        <div class="mb-4 conference-about user-content">
            {!! $conference->getMeta('about') !!}
        </div>
    @endif
    @if($nextScheduledConference || $pastScheduledConferences->isNotEmpty())
    <div class="space-y-6 scheduled-conferences">
        @if($nextScheduledConference)
            <div class="next-scheduled-conference">
                <x-website::heading-title :title="__('general.current_conference')" class="mb-5" />
                <div class="gap-4 next-scheduled-conference sm:flex">
                    @if ($nextScheduledConference->hasThumbnail())
                        <div class="next-scheduled-conference-cover max-w-40">
                            <img src="{{ $nextScheduledConference->getThumbnailUrl() }}" alt="{{ $nextScheduledConference->title }}">
                        </div>
                    @endif
                    <div class="flex-1 space-y-3 information">
                        <div>
                            <h3 class="next-scheduled-conference-title">
                                <a href="{{ $nextScheduledConference->getHomeUrl() }}"
                                    class="font-medium link link-primary link-hover">{{ $nextScheduledConference->title }}</a>
                            </h3>
                            <div class="text-sm text-gray-700 next-scheduled-conference-date">
                                @if($nextScheduledConference->date_start)
                                    {{ $nextScheduledConference->date_start->format(Setting::get('format_date')) }}
                                @endif
                                @if($nextScheduledConference->date_end)
                                    - {{ $nextScheduledConference->date_end->format(Setting::get('format_date')) }}
                                @endif
                            </div>
                        </div>

                        @if ($nextScheduledConference->getMeta('summary'))
                            <div class="scheduled-conference-summary user-content">
                                {!! $nextScheduledConference->getMeta('summary') !!}
                            </div>
                        @endif
                        <div class="next-scheduled-conference-link">
                            <a href="{{ $nextScheduledConference->getHomeUrl() }}" class="text-sm link link-primary">{{ __('general.view_current_event') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($upcomingScheduledConferences->isNotEmpty())
            <div class="scheduled-conferences">
                <x-website::heading-title :title="__('general.upcoming_conference')" class="mb-5" />
                <div class="space-y-6">
                    @foreach ($upcomingScheduledConferences as $scheduledConference)
                        <div class="gap-4 scheduled-conference sm:flex">
                            @if ($scheduledConference->hasThumbnail())
                                <div class="scheduled-conference-cover max-w-40">
                                    <img src="{{ $scheduledConference->getThumbnailUrl() }}" alt="{{ $scheduledConference->title }}">
                                </div>
                            @endif
                            <div class="flex-1 space-y-3 information">
                                <div>
                                    <h3 class="scheduled-conference-title">
                                        <a href="{{ $scheduledConference->getHomeUrl() }}"
                                            class="font-medium link link-primary link-hover">{{ $scheduledConference->title }}</a>
                                    </h3>
                                    <div class="text-sm text-gray-700 scheduled-conference-date">
                                        @if($scheduledConference->date_start)
                                            {{ $scheduledConference->date_start->format(Setting::get('format_date')) }}
                                        @endif
                                        @if($scheduledConference->date_end)
                                            - {{ $scheduledConference->date_end->format(Setting::get('format_date')) }}
                                        @endif
                                    </div>
                                </div>

                                @if ($scheduledConference->getMeta('summary'))
                                    <div class="scheduled-conference-summary user-content">
                                        {!! $scheduledConference->getMeta('summary') !!}
                                    </div>
                                @endif
                                <div class="scheduled-conference-link">
                                    <a href="{{ $scheduledConference->getHomeUrl() }}" class="text-sm link link-primary">{{ __('general.view_event') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($pastScheduledConferences->isNotEmpty())
            <div class="scheduled-conferences">
                <x-website::heading-title :title="__('general.past_conference')" class="mb-5" />
                <div class="space-y-6">
                     @foreach ($pastScheduledConferences as $scheduledConference)
                        <div class="gap-4 scheduled-conference sm:flex">
                            @if ($scheduledConference->hasThumbnail())
                                <div class="scheduled-conference-cover max-w-40">
                                    <img src="{{ $scheduledConference->getThumbnailUrl() }}" alt="{{ $scheduledConference->title }}">
                                </div>
                            @endif
                            <div class="flex-1 space-y-3 information">
                                <div>
                                    <h3 class="scheduled-conference-title">
                                        <a href="{{ $scheduledConference->getHomeUrl() }}"
                                            class="font-medium link link-primary link-hover">{{ $scheduledConference->title }}</a>
                                    </h3>
                                    <div class="text-sm text-gray-700 scheduled-conference-date">
                                        @if($scheduledConference->date_start)
                                            {{ $scheduledConference->date_start->format(Setting::get('format_date')) }}
                                        @endif
                                        @if($scheduledConference->date_end)
                                            - {{ $scheduledConference->date_end->format(Setting::get('format_date')) }}
                                        @endif
                                    </div>
                                </div>

                                @if ($scheduledConference->getMeta('summary'))
                                    <div class="scheduled-conference-summary user-content">
                                        {!! $scheduledConference->getMeta('summary') !!}
                                    </div>
                                @endif
                                <div class="scheduled-conference-link">
                                    <a href="{{ $scheduledConference->getHomeUrl() }}" class="text-sm link link-primary">{{ __('general.view_event') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    @endif
</x-website::layouts.main>
