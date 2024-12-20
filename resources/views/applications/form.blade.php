<x-app-layout :title="isset($application) ? __('Update :name', ['name' => $application->name]) : __('Create Application')">

    <form
        method="POST"
        class="max-w-2xl mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
        action="{{ isset($application) ? route('applications.update', $application) : route('applications.store') }}"
        enctype="multipart/form-data"
        x-data="{ models: {{ json_encode(isset($application) ? $application->models->map(fn ($model) => $model->getAttributes()) : []) }} }"
     >
        @csrf
        @method(isset($application) ? 'patch' : 'post')

        <div class="col-span-full">
            <label for="logo" class="block text-sm/6 font-medium text-gray-900">
                {{ __('Logo' )}}
            </label>
            <div
                class="mt-2 flex items-center gap-x-3"
                x-data="{
                    logoUrl: '{{ $application->logo_url ?? '/images/default-application.png' }}',
                    clear() {
                        this.$refs.fileInput.value = null;
                        this.$refs.clearInput.name = 'logo_clear';
                        this.logoUrl = '/images/default-application.png';
                    },
                    update() {
                        if (!this.$refs.fileInput.files.length) {
                            this.$refs.fileInput.value = null;
                            this.logoUrl = '{{ $application->logo_url ?? '/images/default-application.png' }}';

                            return;
                        }

                        const reader = new FileReader();

                        reader.onerror = e => console.error(e);
                        reader.onload = e => (this.logoUrl = e.target.result);
                        reader.readAsDataURL(this.$refs.fileInput.files[0]);

                        this.$refs.clearInput.name = null;
                    }
                }"
            >
                <img :src="logoUrl" class="size-12 object-cover rounded border border-gray-100" aria-hidden="true">
                <div class="relative rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <input
                        name="logo"
                        type="file"
                        accept="image/png, image/jpeg"
                        class="opacity-0 absolute inset-0"
                        x-ref="fileInput"
                        @change="update()"
                    >
                    <input x-ref="clearInput" type="hidden" value="1">
                    <span aria-hidden="true">{{ __('Change') }}</span>
                </div>
                <button
                    type="button"
                    @click="clear()"
                    class="flex items-center space-x-1 justify-center rounded bg-red-600 p-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/>
                    </svg>
                </button>
            </div>
          </div>

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

        <template x-for="(model, index) in models" :key="index">
            <div class="col-span-full flex flex-col space-y-6 sm:flex-row sm:space-y-0 sm:space-x-6">
                <div>
                    <label :for="`models-${index}-name`" class="block text-sm/6 font-medium text-gray-900">
                        {!! __('Model #<span x-text="index"></span> name') !!}
                    </label>
                    <div class="mt-2">
                        <input
                            :id="`models-${index}-name`"
                            :name="`models[${index}][name]`"
                            :value="model.name"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-200 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            required
                        >
                    </div>
                </div>
                <div class="sm:flex-grow">
                    <label :for="`models-${index}-url`" class="block text-sm/6 font-medium text-gray-900">
                        {!! __('Model #<span x-text="index"></span> url') !!}
                    </label>
                    <div class="mt-2">
                        <input
                            :id="`models-${index}-url`"
                            :name="`models[${index}][url]`"
                            :value="model.url"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            required
                        >
                    </div>
                </div>
                <div class="flex items-end">
                    <button
                        type="button"
                        @click="models.splice(index, 1)"
                        class="flex items-center space-x-1 flex-grow justify-center rounded bg-red-600 p-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 hidden sm:block" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/>
                        </svg>
                        <span class="sm:sr-only">
                            {!! __('Delete model #<span x-text="index"></span>') !!}
                        </span>
                    </button>
                </div>
            </div>
        </template>

        @if ($errors->any())
            <ul class="col-span-full text-red-500">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <div class="sm:col-span-full flex sm:space-x-6 justify-end flex-col sm:flex-row sm:space-y-0 space-y-6">
            <button
                type="button"
                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                @click="models.push({ name: '', url: '' })"
            >
                {{ __('Add model') }}
            </button>

            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                {{ isset($application) ? __('Save') : __('Create') }}
            </button>
        </div>
    </form>

</x-app-layout>
