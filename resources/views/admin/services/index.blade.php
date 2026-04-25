<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Service Catalog') }}</h2>
            <a href="{{ route('admin.services.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">{{ __('Create Service') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Duration') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Price') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Active') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($services as $service)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $service->name }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $service->duration_minutes }} {{ __('minutes') }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-900">@if($service->price) ${{ number_format($service->price, 2) }} @else {{ __('N/A') }} @endif</td>
                                    <td class="px-4 py-4 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">{{ $service->is_active ? __('Active') : __('Inactive') }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-sm space-x-2">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white hover:bg-indigo-700">{{ __('Edit') }}</a>
                                        <form method="POST" action="{{ route('admin.services.toggle', $service) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center rounded-md bg-gray-800 px-3 py-1 text-xs font-semibold text-white hover:bg-gray-900">{{ $service->is_active ? __('Deactivate') : __('Activate') }}</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="inline" onsubmit="return confirm('{{ __('Delete this service?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">{{ __('No services available yet.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
