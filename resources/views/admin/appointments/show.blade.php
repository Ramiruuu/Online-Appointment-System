<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Appointment Details') }}</h2>
            <a href="{{ route('admin.appointments.index') }}" class="rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-900">{{ __('Back to list') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-lg border border-gray-200 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('User') }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->user->email }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->user->phone }}</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Service') }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->service->name }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->service->description }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-lg border border-gray-200 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Date & Time') }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Status') }}</p>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">{{ ucfirst($appointment->status) }}</span>
                    </div>
                </div>

                @if($appointment->cancellation_reason)
                    <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                        <p class="text-sm font-semibold text-red-800">{{ __('Cancellation Reason') }}</p>
                        <p class="text-sm text-red-700">{{ $appointment->cancellation_reason }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
