<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $appointment->service->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $appointment->service->description }}</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-lg border border-gray-200 p-4">
                            <p class="text-sm font-semibold text-gray-700">{{ __('Client') }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->user->email }}</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 p-4">
                            <p class="text-sm font-semibold text-gray-700">{{ __('Date & Time') }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</p>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Status') }}</p>
                        <p class="text-sm text-gray-600">{{ ucfirst($appointment->status) }}</p>
                    </div>

                    @if($appointment->cancellation_reason)
                        <div class="rounded-lg border border-gray-200 p-4 bg-red-50">
                            <p class="text-sm font-semibold text-gray-700">{{ __('Cancellation Reason') }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->cancellation_reason }}</p>
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <a href="{{ route('appointments.index') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">{{ __('Back to appointments') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
