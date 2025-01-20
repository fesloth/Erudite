<x-website::layouts.main>
    {{-- <div class="h-screen overflow-hidden">

    <button id="left-slider" class="absolute z-10 w-16 h-16 transform -translate-y-1/2 bg-gray-200 rounded-full shadow-lg top-1/2 left-4 hover:bg-gray-300">
        <i class="fa-solid fa-angle-left"></i>
    </button>
    <button id="right-slider" class="absolute z-10 w-16 h-16 transform -translate-y-1/2 bg-gray-200 rounded-full shadow-lg top-1/2 right-4 hover:bg-gray-300">
        <i class="fa-solid fa-angle-right"></i>
    </button>

    <div class="flex h-full transition-transform duration-500" id="slidder-wrapper">
        <div class="flex h-full min-w-full">
            <div class="flex flex-col items-start justify-center w-1/2 p-16 text-white bg-[#C5BAFF]">
                <i class="mb-4 text-[40px] font-bold">{{ $nextScheduledConference->title }} conference 2025</i>
                <div class="text-sm text-white next-scheduled-conference-date">
                    @if($nextScheduledConference->date_start)
                        {{ $nextScheduledConference->date_start->format(Setting::get('format_date')) }}
                    @endif
                    @if($nextScheduledConference->date_end)
                        - {{ $nextScheduledConference->date_end->format(Setting::get('format_date')) }}
                    @endif
                </div>
                <a href="#" class="px-6 py-3 bg-[#A294F9] text-white mt-5 font-semibold rounded-lg">
                    Buy Yout Ticket
                </a>
            </div>
            <div class="w-1/2 h-full bg-center bg-cover">
                <img src="" alt="tes">
            </div>
        </div>

        <div class="flex h-full min-w-full">
            <div class="w-1/2 bg-[#C5BAFF] text-white flex flex-col justify-center items-start p-16">
                <h1 class="mb-4 text-4xl font-bold">Virtual Summit 2025</h1>
                <p class="p-6 text-lg">5 - 7 April 2025 | Online Event</p>
            </div>
        </div>
    </div>

    <h3 class="next-scheduled-conference-title">
        <a href="{{ $nextScheduledConference->getHomeUrl() }}"
            class="font-medium btn bg-[#CDC1FF] hover:bg-[#E5D9F2] text-white hover:text-[#A294F9] border-none">See Detail</a>
    </h3>

    <div class="grid grid-flow-col gap-5 mt-5 text-center auto-cols-max">
        <div class="flex flex-col">
          <span class="font-mono text-5xl countdown">
            <span style="--value:15;"></span>
          </span>
          days
        </div>
        <div class="flex flex-col">
          <span class="font-mono text-5xl countdown">
            <span style="--value:10;"></span>
          </span>
          hours
        </div>
        <div class="flex flex-col">
          <span class="font-mono text-5xl countdown">
            <span style="--value:24;"></span>
          </span>
          min
        </div>
        <div class="flex flex-col">
          <span class="font-mono text-5xl countdown">
            <span style="--value:${counter};"></span>
          </span>
          sec
        </div>
      </div>
</div> --}}
    @if ($conference->hasMedia('cover'))
        <div class="conference-cover">

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
