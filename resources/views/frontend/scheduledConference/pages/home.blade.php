<x-website::layouts.main>
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
    </div>
</x-website::layouts.main>
