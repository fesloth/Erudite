@props([
    'sidebars' => \App\Facades\SidebarFacade::get(),
])


<div @class(['page-main'])>
    <div @class(['page-content' => $sidebars->isNotEmpty(), 'lg:col-span-full' => !$sidebars->isNotEmpty()])>
        {{ $slot }}
    </div>

    @if ($sidebars->isNotEmpty())
        <x-website::layouts.sidebar :sidebars="$sidebars"/>
    @endif
</div>
