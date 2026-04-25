<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold tracking-tight text-white">{{ __('Book an Appointment') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="app-card p-8">
            @if(session('error'))
                <div class="mb-6 rounded-3xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm text-rose-200">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="service_id" :value="__('Select Service')" class="form-label" />
                    <select id="service_id" name="service_id" required class="form-input mt-2">
                        <option value="">{{ __('Choose a service') }}</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} @if($service->price) - ${{ number_format($service->price, 2) }}@endif
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('service_id')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div>
                    <x-input-label for="appointment_date" :value="__('Appointment Date & Time')" class="form-label" />
                    <x-text-input id="appointment_date" class="form-input mt-2" type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required />
                    <x-input-error :messages="$errors->get('appointment_date')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="btn-primary">{{ __('Confirm Booking') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
