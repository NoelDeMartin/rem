<x-applications-layout>

    <h2>
        {{ $application->name }}
    </h2>

    <p>{{ $application->description }}</p>

    <table>
        <tr>
            <th>Slug</th>
            <td>{{ $application->slug }}</td>
        </tr>
        <tr>
            <th>Url</th>
            <td><a href="{{ $application->url }}" target="_blank">{{ $application->url }}</a></td>
        </tr>
    </table>

    <a href="{{ route('applications.edit', $application) }}">{{ __('Edit') }}</a>

    {{-- TODO confirm --}}
    <form method="POST" action="{{ route('applications.destroy', $application) }}">
        @csrf
        @method('delete')

        <button>{{ __('Delete') }}</button>
    </form>

</x-applications-layout>
