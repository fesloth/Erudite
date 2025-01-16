@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
@endphp

@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div class="navbar-container bg-[#A294F9] text-white shadow z-50">
        <div class="justify-between mx-auto navbar max-w-7xl">
            <div class="items-center gap-2 navbar-start w-max">
                <x-website::navigation-menu-mobile />
                <x-website::logo :headerLogo="$headerLogo"/>
            </div>
            <div class="relative z-10 hidden navbar-end lg:flex w-max">
                <x-website::navigation-menu :items="$primaryNavigationItems" />
                <x-website::navigation-menu :items="$userNavigationMenu" class="text-gray-800" />
            </div>
        </div>
    </div>
@endif
