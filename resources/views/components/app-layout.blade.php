@props(['title'])

@php
    $sections = [
        (object) [
            'name' => __('Applications'),
            'url' => route('applications.index'),
            'current' => Route::is('applications.*'),
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>

    <body class="h-full font-sans text-gray-900 antialiased">
        <div class="min-h-full flex flex-col">
            <div class="py-10 flex flex-col flex-grow">
                @isset($title)
                    <header>
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                                {{ $title }}
                            </h1>
                        </div>
                    </header>
                @endisset
                <main class="flex flex-col flex-grow">
                    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col flex-grow {{ isset($title) ? 'py-8' : 'pb-8' }}">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
