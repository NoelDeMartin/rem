<x-app-layout>

    <h1>
        {{ __('Applications') }}
    </h1>

    @empty($applications)
        <p>{{ __('No applications yet') }}</p>
    @else
        <ul>
            @foreach ($applications as $application)
                <li>
                    <a href="{{ route('applications.show', $application) }}">{{ $application->name }}</a>
                </li>
            @endforeach
        </ul>
    @endempty

    <a href="{{ route('applications.create') }}">
        {{ __('Create Application') }}
    </a>

</x-app-layout>
