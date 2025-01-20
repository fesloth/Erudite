<x-website::layouts.main>
{{--
    <div class="space-y-8">
        <x-scheduledConference::alert-scheduled-conference :scheduled-conference="$currentScheduledConference" />
        @if ($currentScheduledConference->hasMedia('cover')||$currentScheduledConference->getMeta('about')||$currentScheduledConference->getMeta('additional_content'))
            <section id="highlight" class="space-y-4">
                <div class="flex flex-col flex-wrap gap-4 space-y-4 sm:flex-row sm:space-y-0">
                    <div class="flex flex-col flex-1 gap-4">
                        @if ($currentScheduledConference->hasMedia('cover'))
                            <div class="cf-cover">
                                <img class="h-full"
                                    src="{{ $currentScheduledConference->getFirstMedia('cover')->getAvailableUrl(['thumb', 'thumb-xl']) }}"
                                    alt="{{ $currentScheduledConference->title }}" />
                            </div>
                        @endif
                        @if ($currentScheduledConference->getMeta('about'))
                            <div class="user-content">
                                {{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('about')) }}
                            </div>
                        @endif
                        @if ($currentScheduledConference->getMeta('additional_content'))
                            <div class="user-content">
                                {{ new Illuminate\Support\HtmlString($currentScheduledConference->getMeta('additional_content')) }}
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        @if ($currentScheduledConference?->speakers->isNotEmpty())
            <section id="speakers" class="flex flex-col gap-y-0">
                <x-website::heading-title title="Speakers" class="mb-5"/>
                <div class="space-y-6 cf-speakers">
                    @foreach ($currentScheduledConference->speakerRoles as $role)
                        @if ($role->speakers->isNotEmpty())
                            <div class="space-y-4">
                                <h3 class="text-lg">{{ $role->name }}</h3>
                                <div class="grid gap-2 cf-speaker-list sm:grid-cols-2">
                                    @foreach ($role->speakers as $speaker)
                                        <div class="flex items-center h-full gap-2 cf-speaker">
                                            <img class="object-cover w-16 h-16 rounded-full cf-speaker-img aspect-square"
                                                src="{{ $speaker->getFilamentAvatarUrl() }}"
                                                alt="{{ $speaker->fullName }}" />
                                            <div class="space-y-1 cf-speaker-information">
                                                <div class="text-gray-900 cf-speaker-name">
                                                    {{ $speaker->fullName }}
                                                </div>
                                                @if ($speaker->getMeta('affiliation'))
                                                    <div class="text-xs text-gray-700 cf-speaker-affiliation">
                                                        {{ $speaker->getMeta('affiliation') }}</div>
                                                @endif
                                                @if($speaker->getMeta('scopus_url') || $speaker->getMeta('google_scholar_url') || $speaker->getMeta('orcid_url'))
                                                    <div class="flex flex-wrap items-center gap-1 cf-committee-scholar">
                                                        @if($speaker->getMeta('orcid_url'))
                                                        <a href="{{ $speaker->getMeta('orcid_url') }}" target="_blank">
                                                            <x-academicon-orcid class="orcid-logo" />
                                                        </a>
                                                        @endif
                                                        @if($speaker->getMeta('google_scholar_url'))
                                                        <a href="{{ $speaker->getMeta('google_scholar_url') }}" target="_blank">
                                                            <x-academicon-google-scholar class="google-scholar-logo" />
                                                        </a>
                                                        @endif
                                                        @if($speaker->getMeta('scopus_url'))
                                                        <a href="{{ $speaker->getMeta('scopus_url') }}" target="_blank">
                                                            <x-academicon-scopus class="scopus-logo" />
                                                        </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        @if($sponsorLevels->isNotEmpty() || $sponsorsWithoutLevel->isNotEmpty())
            <section class="sponsors">
                <x-website::heading-title title="Sponsors" class="mb-5"/>
                <div class="space-y-6 conference-sponsor-levels">
                    @if($sponsorsWithoutLevel->isNotEmpty())
                        <div class="conference-sponsor-level">
                            <div class="flex flex-wrap items-center gap-4 conference-sponsors">
                                @foreach($sponsorsWithoutLevel as $sponsor)
                                    @if(!$sponsor->getFirstMedia('logo'))
                                        @continue
                                    @endif
                                    <x-scheduledConference::conference-sponsor :sponsor="$sponsor" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @foreach ($sponsorLevels as $sponsorLevel)
                        <div class="conference-sponsor-level">
                            <h3 class="mb-4 text-lg">{{ $sponsorLevel->name }}</h3>
                            <div class="flex flex-wrap items-center gap-4 conference-sponsors">
                                @foreach($sponsorLevel->stakeholders as $sponsor)
                                    @if(!$sponsor->getFirstMedia('logo'))
                                        @continue
                                    @endif
                                    <x-scheduledConference::conference-sponsor :sponsor="$sponsor" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        @if($partners->isNotEmpty())
            <section class="partners">
                <x-website::heading-title title="Partners" class="mb-5"/>
                <div class="flex flex-wrap items-center gap-4 conference-partners">
                    @foreach($partners as $partner)
                        @if(!$partner->getFirstMedia('logo'))
                            @continue
                        @endif
                        <x-scheduledConference::conference-partner :partner="$partner" />
                    @endforeach
                </div>
            </section>
        @endif
    </div> --}}
    <div class="relative h-screen overflow-hidden">

        <button id="left-slider" class="absolute z-10 w-16 h-16 transform -translate-y-1/2 bg-gray-200 rounded-full shadow-lg top-1/2 left-4 hover:bg-gray-300">
            <i class="fa-solid fa-angle-left"></i>
        </button>
        <button id="right-slider" class="absolute z-10 w-16 h-16 transform -translate-y-1/2 bg-gray-200 rounded-full shadow-lg top-1/2 right-4 hover:bg-gray-300">
            <i class="fa-solid fa-angle-right"></i>
        </button>

        <div class="flex h-full transition-transform duration-500" id="slider-wrapper">
            <div class="flex h-full min-w-full">
                <div class="flex flex-col items-start justify-center w-1/2 p-16 text-white bg-[#C5BAFF]">
                    <i class="mb-4 text-[40px] font-bold">{{ $currentScheduledConference->title }} conference 2025</i>
                    <div class="text-sm text-white current-scheduled-conference-date">
                        @if($currentScheduledConference->date_start)
                            {{ $currentScheduledConference->date_start->format(Setting::get('format_date')) }}
                        @endif
                        @if($currentScheduledConference->date_end)
                            - {{ $currentScheduledConference->date_end->format(Setting::get('format_date')) }}
                        @endif
                    </div>
                    <a href="#" class="px-6 py-3 bg-[#A294F9] hover:bg-[#b5a8f7] text-white mt-5 font-semibold rounded-lg">
                        Buy Your Ticket
                    </a>
                </div>
                <div class="relative w-1/2">
                    <img src="{{ asset('ppll.jpeg') }}" class="object-cover w-full h-full">
                </div>
            </div>
            <div class="flex h-full min-w-full">
                <div class="w-1/2 bg-[#C5BAFF] text-white flex flex-col justify-center items-start p-16">
                    <h1 class="mb-4 text-4xl font-bold">Virtual Summit 2025</h1>
                    <p class="p-6 text-lg">5 - 7 April 2025 | Online Event</p>
                    <a href="#" class="px-6 py-3 bg-[#A294F9] hover:bg-[#b5a8f7] text-white mt-5 font-semibold rounded-lg">
                        Learn More
                    </a>
                </div>
                <div class="relative w-1/2">
                    <img src="{{ asset('ppll.jpeg') }}" class="object-cover w-full h-full">
                </div>
            </div>
    </div>
        </div>
        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll("#slider-wrapper > div");
            const totalSlides = slides.length;

            document.getElementById("left-slider").addEventListener("click", () => {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                document.getElementById("slider-wrapper").style.transform = `translateX(-${currentSlide * 100}%)`;
            })
            document.getElementById("right-slider").addEventListener("click", () => {
                currentSlide = (currentSlide + 1) % totalSlides;
                document.getElementById("slider-wrapper").style.transform = `translateX(-${currentSlide * 100}%)`;
            })
        </script>

        {{-- <h3 class="next-scheduled-conference-title">
            <a href="{{ $currentScheduledConference->getHomeUrl() }}"
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
    <div class="w-full py-12 bg-[#A294F9]">
    </div>
    <div class="flex flex-col items-center justify-center my-28 mx-72">
        <a href="https://leconfe.com" rel="external" target="_blank" class="flex items-center mx-auto text-sm gap-x-2">
			<img src="{{ Vite::asset('resources/assets/images/logo.png') }}" class="h-16" alt="leconfe-logo-footer">
			<span class="font-medium text-gray-500">Leconfe</span>
		</a>
        <p class="my-6 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <a href="{{ $currentScheduledConference->getHomeUrl() }}"
            class="font-medium btn w-32 bg-[#CDC1FF] hover:bg-[#E5D9F2] text-white hover:text-[#A294F9] border-none">See Detail</a>
    </div>

    <div class="flex flex-col items-center justify-center w-full mt-12">
        @if ($currentScheduledConference?->speakers->isNotEmpty())
        <section id="speakers" class="flex flex-col items-center justify-center mx-auto">
            <h1 class="text-[40px] text-center mb-10">Event Speaker</h1>
            <div class="space-y-6 cf-speakers">
                @foreach ($currentScheduledConference->speakerRoles as $role)
                    @if ($role->speakers->isNotEmpty())
                        <div class="space-y-4">
                            <h3 class="text-lg text-center">{{ $role->name }}</h3>
                            <div class="grid gap-9 cf-speaker-list sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($role->speakers as $speaker)
                                    <div class="flex flex-col items-center justify-center h-full gap-2 cf-speaker">
                                        <img class="object-cover w-48 h-48 rounded-full cf-speaker-img aspect-square"
                                            src="{{ $speaker->getFilamentAvatarUrl() }}"
                                            alt="{{ $speaker->fullName }}" />
                                        <div class="space-y-1 cf-speaker-information">
                                            <div class="text-center text-gray-900 cf-speaker-name">
                                                {{ $speaker->fullName }}
                                            </div>
                                            @if ($speaker->getMeta('affiliation'))
                                                <div class="text-xs text-center text-gray-700 cf-speaker-affiliation">
                                                    {{ $speaker->getMeta('affiliation') }}</div>
                                            @endif
                                            @if($speaker->getMeta('scopus_url') || $speaker->getMeta('google_scholar_url') || $speaker->getMeta('orcid_url'))
                                                <div class="flex flex-wrap items-center gap-1 cf-committee-scholar">
                                                    @if($speaker->getMeta('orcid_url'))
                                                    <a href="{{ $speaker->getMeta('orcid_url') }}" target="_blank">
                                                        <x-academicon-orcid class="orcid-logo" />
                                                    </a>
                                                    @endif
                                                    @if($speaker->getMeta('google_scholar_url'))
                                                    <a href="{{ $speaker->getMeta('google_scholar_url') }}" target="_blank">
                                                        <x-academicon-google-scholar class="google-scholar-logo" />
                                                    </a>
                                                    @endif
                                                    @if($speaker->getMeta('scopus_url'))
                                                    <a href="{{ $speaker->getMeta('scopus_url') }}" target="_blank">
                                                        <x-academicon-scopus class="scopus-logo" />
                                                    </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    <div class="flex justify-center w-full mt-48 mb-48">
        <img src="{{ asset('ppl.jpeg') }}" class="">
    </div>

    <div class="mt-12">
        @if($sponsorLevels->isNotEmpty() || $sponsorsWithoutLevel->isNotEmpty())
        <section class="sponsors">
           <h1 class="mb-5 text-center text-[40px]">Official Sponsors & Partners</h1>
            <div class="space-y-6 conference-sponsor-levels">
                @if($sponsorsWithoutLevel->isNotEmpty())
                    <div class="conference-sponsor-level">
                        <div class="flex flex-wrap items-center justify-center gap-4 conference-sponsors">
                            @foreach($sponsorsWithoutLevel as $sponsor)
                                @if(!$sponsor->getFirstMedia('logo'))
                                    @continue
                                @endif
                                <x-scheduledConference::conference-sponsor :sponsor="$sponsor" />
                            @endforeach
                        </div>
                    </div>
                @endif
                @foreach ($sponsorLevels as $sponsorLevel)
                    <div class="conference-sponsor-level">
                        <h3 class="mb-4 text-lg font-bold text-center text-[25px] mt-12">{{ $sponsorLevel->name }} sponsors</h3>
                        <div class="flex flex-wrap items-center justify-center gap-4 conference-sponsors">
                            @foreach($sponsorLevel->stakeholders as $sponsor)
                                @if(!$sponsor->getFirstMedia('logo'))
                                    @continue
                                @endif
                                <x-scheduledConference::conference-sponsor :sponsor="$sponsor" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    @if($partners->isNotEmpty())
        <section class="partners">
           <p class="font-bold text-[25px] my-10 text-center">Partners</p>
            <div class="flex flex-wrap items-center justify-center gap-4 conference-partners">
                @foreach($partners as $partner)
                    @if(!$partner->getFirstMedia('logo'))
                        @continue
                    @endif
                    <x-scheduledConference::conference-partner :partner="$partner" />
                @endforeach
            </div>
        </section>
    @endif
</div>
<button class="mt-10 btn bg-[#A294F9] text-white">BECOME A SPONSOR</button>
    </div>

    <div class="flex flex-col items-center justify-center gap-5 mx-auto mt-48 mb-48 ">
        <h1 class="text-[40px]">Sign Up for Our Newsletter</h1>
        <div class="flex gap-5">
            <label class="flex items-center gap-2 input input-bordered">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 16 16"
                  fill="currentColor"
                  class="w-4 h-4 opacity-70">
                  <path
                    d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                  <path
                    d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                </svg>
                <input type="text" class="grow input input-md" placeholder="Email" />
              </label>
        <button class="btn bg-[#A294F9] text-white">Subscribe</button>
    </div>
    </div>

    </div>
</x-website::layouts.main>
