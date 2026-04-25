<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Upcoming Appointments') }}</h3>
                    <div class="mt-4 space-y-4">
                        @forelse($upcoming as $appointment)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800">{{ $appointment->service->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</div>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">{{ ucfirst($appointment->status) }}</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <a href="{{ route('appointments.show', $appointment) }}" class="text-sm text-indigo-600 hover:text-indigo-900">{{ __('View details') }}</a>
                                    @if(in_array($appointment->status, ['pending', 'confirmed']) && $appointment->appointment_date->isFuture())
                                        <details class="rounded border border-gray-200 bg-gray-50 p-3">
                                            <summary class="cursor-pointer text-sm font-medium text-red-600">{{ __('Cancel appointment') }}</summary>
                                            <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" class="mt-3 space-y-3">
                                                @csrf
                                                @method('DELETE')

                                                <div>
                                                    <x-input-label for="cancellation_reason_{{ $appointment->id }}" :value="__('Cancellation Reason')" />
                                                    <textarea id="cancellation_reason_{{ $appointment->id }}" name="cancellation_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" required>{{ old('cancellation_reason') }}</textarea>
                                                    <x-input-error :messages="$errors->get('cancellation_reason')" class="mt-2" />
                                                </div>

                                                <x-primary-button class="bg-red-600 hover:bg-red-700">
                                                    {{ __('Submit cancellation') }}
                                                </x-primary-button>
                                            </form>
                                        </details>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">{{ __('You have no upcoming appointments.') }}</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Past Appointments') }}</h3>
                    <div class="mt-4 space-y-4">
                        @forelse($past as $appointment)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800">{{ $appointment->service->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</div>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">{{ ucfirst($appointment->status) }}</span>
                                </div>
                                @if($appointment->cancellation_reason)
                                    <div class="mt-3 text-sm text-gray-600">
                                        <strong>{{ __('Reason:') }}</strong> {{ $appointment->cancellation_reason }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">{{ __('You have no past appointments.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
