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

        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>

    <body class="h-full">
        <div class="min-h-full flex flex-col">
            <nav x-data="{ showMenu: false }" class="border-b border-gray-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <div class="flex shrink-0 items-center">
                                <a href="{{ route('home') }}" aria-label="{{ __('Home') }}">
                                    <svg class="size-8" viewBox="0 0 24 24">
                                        <path fill="#96c4fa" d="M19.582 18.52A9.96 9.96 0 0 0 22 12a9.96 9.96 0 0 0-2.418-6.52l-4.273 4.272c.436.64.691 1.414.691 2.248s-.255 1.608-.691 2.248zm-1.062 1.062A9.96 9.96 0 0 1 12 22a9.96 9.96 0 0 1-6.52-2.418l4.272-4.273c.64.436 1.414.691 2.248.691s1.608-.255 2.248-.691zM4.418 18.52l4.273-4.272A4 4 0 0 1 8 12c0-.834.255-1.607.691-2.248L4.418 5.479A9.96 9.96 0 0 0 2 12a9.96 9.96 0 0 0 2.418 6.52M12 8c-.834 0-1.607.255-2.248.691L5.479 4.418A9.96 9.96 0 0 1 12 2a9.96 9.96 0 0 1 6.52 2.418l-4.272 4.273A4 4 0 0 0 12 8"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                                @foreach ($sections as $section)
                                    <a
                                        href="{{ $section->url }}"
                                        class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium {{ $section->current ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}"
                                        {{ $section->current && 'aria-current="page"' }}
                                    >
                                        {{ $section->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                type="button"
                                class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                aria-controls="mobile-menu"
                                :aria-expanded="showMenu"
                                @click="showMenu = !showMenu"
                            >
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">{{ __('Open main menu') }}</span>
                                <svg class="size-6" :class="showMenu ? 'hidden' : 'block'" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg class="size-6" :class="showMenu ? 'block' : 'hidden'" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div x-show="showMenu" class="sm:hidden" id="mobile-menu">
                    <div class="space-y-1 pb-3 pt-2">
                        @foreach ($sections as $section)
                            <a
                                href="{{ $section->url }}"
                                class="block border-l-4 py-2 pr-4 pl-3 text-base font-medium {{ $section->current ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800' }}"
                                {{ $section->current && 'aria-current="page"' }}
                            >
                                {{ $section->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>

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
