<x-applications-layout>

    <h2>
        {{ isset($application) ? __('Update :name', ['name' => $application->name]) : __('Create Application') }}
    </h2>

    <form
        method="POST"
        action="{{ isset($application) ? route('applications.update', $application) : route('applications.store') }}"
     >
        @csrf
        @method(isset($application) ? 'patch' : 'post')

        <label for="slug">
            {{ __('Slug') }}
        </label>

        <input id="slug" name="slug" value="{{ old('slug', $application->slug ?? '') }}" required />

        <label for="name">
            {{ __('Name') }}
        </label>

        <input id="name" name="name" value="{{ old('name', $application->name ?? '') }}" required />

        <label for="description">
            {{ __('Description') }}
        </label>

        <textarea id="description" name="description" required rows="6">{{ old('description', $application->description ?? '') }}</textarea>

        <label for="url">
            {{ __('Url') }}
        </label>

        <input id="url" name="url" value="{{ old('url', $application->url ?? '') }}" required />

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <br>

        <button>
            {{ isset($application) ? __('Save') : __('Create') }}
        </button>

    </form>

</x-applications-layout>
