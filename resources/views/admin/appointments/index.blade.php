<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Admin Appointment Management') }}</h2>
            <a href="{{ route('admin.services.index') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">{{ __('Manage Services') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" class="grid gap-4 lg:grid-cols-5">
                    <div>
                        <x-input-label for="search" :value="__('Search')" />
                        <x-text-input id="search" name="search" value="{{ old('search', $search) }}" class="mt-1 block w-full" placeholder="{{ __('Name or email') }}" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">{{ __('All statuses') }}</option>
                            @foreach(['pending','confirmed','completed','cancelled'] as $option)
                                <option value="{{ $option }}" {{ $status === $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="__('From date')" />
                        <x-text-input id="start_date" type="date" name="start_date" value="{{ old('start_date', $start_date) }}" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('To date')" />
                        <x-text-input id="end_date" type="date" name="end_date" value="{{ old('end_date', $end_date) }}" class="mt-1 block w-full" />
                    </div>

                    <div class="flex items-end">
                        <x-primary-button>{{ __('Filter') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('User') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Service') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Appointment Date') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div>{{ $appointment->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $appointment->user->email }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->service->name }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 space-y-2">
                                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white hover:bg-indigo-700">{{ __('View') }}</a>
                                        <details class="rounded border border-gray-200 bg-gray-50 p-3">
                                            <summary class="cursor-pointer text-xs font-semibold text-gray-800">{{ __('Update Status') }}</summary>
                                            <form method="POST" action="{{ route('admin.appointments.status', $appointment) }}" class="mt-3 space-y-3">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <x-input-label for="status_{{ $appointment->id }}" :value="__('Status')" />
                                                    <select id="status_{{ $appointment->id }}" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                        @foreach(['pending','confirmed','completed','cancelled'] as $option)
                                                            <option value="{{ $option }}" {{ $appointment->status === $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div>
                                                    <x-input-label for="cancellation_reason_{{ $appointment->id }}" :value="__('Cancellation Reason')" />
                                                    <textarea id="cancellation_reason_{{ $appointment->id }}" name="cancellation_reason" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $appointment->cancellation_reason }}</textarea>
                                                </div>

                                                <x-primary-button class="w-full">{{ __('Save Status') }}</x-primary-button>
                                            </form>
                                        </details>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">{{ __('No appointments found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
