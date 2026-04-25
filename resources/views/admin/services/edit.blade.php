<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Service') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.services.update', $service) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="name" :value="__('Service Name')" />
                            <x-text-input id="name" name="name" type="text" value="{{ old('name', $service->name) }}" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $service->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="duration_minutes" :value="__('Duration (minutes)')" />
                                <x-text-input id="duration_minutes" name="duration_minutes" type="number" min="1" value="{{ old('duration_minutes', $service->duration_minutes) }}" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $service->price) }}" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-input-label for="is_active" :value="__('Active service')" />
                            <x-checkbox id="is_active" name="is_active" {{ $service->is_active ? 'checked' : '' }} />
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.services.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">{{ __('Cancel') }}</a>
                            <x-primary-button>{{ __('Update Service') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
