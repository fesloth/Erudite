@props([
    'title' => null,
])

<head>
    <title>{{ $title ? strip_tags($title) . ' - ' : null }}{{ $contextName ?? config('app.name') }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="application-name" content="Leconfe" />
    <meta name="generator" content="Leconfe {{ app()->getCodeVersion() }}" />

    {{ MetaTag::render() }}

    @if (isset($favicon) && !empty($favicon))
    <link rel="icon" type="image/x-icon" href="{{ $favicon }}" />
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite(['resources/frontend/js/frontend.js'])

    @livewireStyles

    @hook('Frontend::Views::Head')

    @if(isset($styleSheet) && !empty($styleSheet))
        <link rel="stylesheet" type="text/css" href="{{ $styleSheet }}" />
    @endif

    @production
        <x-livewire-handle-error />
    @endproduction
</head>
