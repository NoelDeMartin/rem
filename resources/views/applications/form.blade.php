<x-app-layout :title="isset($application) ? __('Update :name', ['name' => $application->name]) : __('Create Application')">

    <form
        method="POST"
        class="max-w-2xl mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
        action="{{ isset($application) ? route('applications.update', $application) : route('applications.store') }}"
     >
        @csrf
        @method(isset($application) ? 'patch' : 'post')

        <div class="sm:col-span-2">
            <label for="slug" class="block text-sm/6 font-medium text-gray-900">
                {{ __('Slug') }}
            </label>
            <div class="mt-2">
                <input
                    id="slug"
                    name="slug"
                    type="text"
                    value="{{ old('slug', $application->slug ?? '') }}"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-200 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    required
                >
            </div>
        </div>

        <div class="sm:col-span-4">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">
                {{ __('Name') }}
            </label>
            <div class="mt-2">
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $application->name ?? '') }}"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    required
                >
            </div>
        </div>

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-gray-900">
                {{ __('Description') }}
            </label>
            <div class="mt-2">
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    required
                >{{ old('description', $application->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="col-span-full">
            <label for="url" class="block text-sm/6 font-medium text-gray-900">
                {{ __('Url') }}
            </label>
            <div class="mt-2">
                <input
                    id="url"
                    name="url"
                    type="text"
                    value="{{ old('url', $application->url ?? '') }}"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-200 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    required
                >
            </div>
        </div>

        @if ($errors->any())
            <ul class="col-span-full text-red-500">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <button
            type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
            {{ isset($application) ? __('Save') : __('Create') }}
        </button>
    </form>

</x-app-layout>
