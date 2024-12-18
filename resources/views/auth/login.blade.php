<x-app-layout>
    <div class="flex flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm space-y-10">
            <div>
                <x-application-logo class="size-20 mx-auto" />
                <h2 class="mt-2 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                    {{ __('Log in to your account') }}
                </h2>
            </div>
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <div class="col-span-2">
                        <input
                            class="block w-full rounded-t-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:relative focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            name="email"
                            type="email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            aria-label="{{ __('Email address') }}"
                            placeholder="{{ __('Email address') }}"
                            required
                        >
                    </div>
                    <div class="-mt-px">
                        <input
                            class="block w-full rounded-b-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:relative focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            aria-label="{{ __('Password') }}"
                            placeholder="{{ __('Password') }}"
                            required
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        <div class="flex h-6 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                                <input
                                    class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                >
                                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                    <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <label for="remember" class="block text-sm/6 text-gray-900">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                </div>

                @if ($errors->any())
                    <ul class="col-span-full text-red-500">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div>
                    <button
                        type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
