<x-applications-layout>

    <h2>
        {{ $application->name }}
    </h2>

    <code>{{ $application->url }}</code>

    <br>

    <a href="{{ route('applications.edit', $application) }}">{{ __('Edit') }}</a>

    {{-- TODO confirm --}}
    <form method="POST" action="{{ route('applications.destroy', $application) }}">
        @csrf
        @method('delete')

        <button>{{ __('Delete') }}</button>
    </form>

</x-applications-layout>
