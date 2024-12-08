<x-app-layout>
    <h1 class="sr-only">{{ __('Applications') }}</h1>

    @if ($applications->isEmpty())
        <div class="text-center">
            <p class="mt-2 text-sm text-gray-900">{{ __('No apps yet') }}</p>
            <div class="mt-6">
                <a
                    href="{{ route('applications.create') }}"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    <svg class="mr-1.5 -ml-0.5 size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    {{ __('Create Application') }}
                </a>
            </div>
        </div>
    @else
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a
                        href="{{ route('applications.create') }}"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        {{ __('Create Application') }}
                    </a>
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{ __('Slug') }}
                                    </th>
                                    <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
                                        <span class="sr-only">
                                            {{ __('Edit') }}
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($applications as $application)
                                    <tr>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0">
                                            <a href="{{ route('applications.show', $application) }}">
                                                {{ $application->name }}
                                            </a>
                                        </td>
                                        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                            {{ $application->slug }}
                                        </td>
                                        <td class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
                                            <a href="{{ route('applications.edit', $application) }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ __('Edit') }}<span class="sr-only">, {{ $application->name }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endempty
</x-app-layout>
