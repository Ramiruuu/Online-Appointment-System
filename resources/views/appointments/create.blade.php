<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="service_id" :value="__('Select Service')" />
                            <select id="service_id" name="service_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">{{ __('Choose a service') }}</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} @if($service->price) - ${{ number_format($service->price, 2) }}@endif
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="appointment_date" :value="__('Appointment Date & Time')" />
                            <x-text-input id="appointment_date" class="block mt-1 w-full" type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required />
                            <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Confirm Booking') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
