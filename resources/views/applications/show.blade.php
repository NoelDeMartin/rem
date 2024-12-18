<x-app-layout>
    <div>
        <div class="px-4 sm:px-0 flex items-center space-x-2">
            <div class="size-16 shrink-0">
                <img src="{{ $application->logo_url }}" class="size-16 rounded border border-gray-100" alt="">
            </div>
            <div>
                <h1 class="text-base/7 font-semibold text-gray-900">{{ $application->name }}</h1>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">{{ $application->description }}</p>
            </div>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">{{ __('Slug') }}</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <code>{{ $application->slug }}</code>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">{{ __('Url') }}</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <a href="{{ $application->url }}" target="_blank">{{ $application->url }}</a>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">{{ __('Models') }}</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @if ($application->models->isEmpty())
                            -
                        @else
                            <ul class="list-disc space-y-2">
                                @foreach ($application->models as $model)
                                    <li>
                                        {{ $model->name }} <br>
                                        <code class="text-xs">{{ $model->url }}</code>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-4 flex space-x-2">
        <a
            href="{{ route('applications.edit', $application) }}"
            class="items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
            {{ __('Edit') }}
        </a>

        <form
            method="POST"
            action="{{ route('applications.destroy', $application) }}"
            onsubmit="return confirm('{{ __('Are you sure you want to delete this app?') }}')"
        >
            @csrf
            @method('delete')
            <button
                type="submit"
                class="items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
            >
                {{ __('Delete') }}
            </button>
        </form>
    </div>

</x-app-layout>
