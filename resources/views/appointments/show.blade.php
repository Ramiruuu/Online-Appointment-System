<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold tracking-tight text-white">{{ __('Appointment Details') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="app-card p-8">
            <div class="space-y-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">{{ __('Service') }}</p>
                    <h3 class="mt-2 text-3xl font-semibold text-white">{{ $appointment->service->name }}</h3>
                    <p class="mt-2 text-sm text-slate-400">{{ $appointment->service->description }}</p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-700/60 bg-slate-950/70 p-5">
                        <p class="text-sm font-semibold text-slate-300">{{ __('Client') }}</p>
                        <p class="mt-3 text-base text-white">{{ $appointment->user->name }}</p>
                        <p class="text-sm text-slate-400">{{ $appointment->user->email }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700/60 bg-slate-950/70 p-5">
                        <p class="text-sm font-semibold text-slate-300">{{ __('Date & Time') }}</p>
                        <p class="mt-3 text-base text-white">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</p>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-700/60 bg-slate-950/70 p-5">
                    <p class="text-sm font-semibold text-slate-300">{{ __('Status') }}</p>
                    <p class="mt-2 text-base text-white">{{ ucfirst($appointment->status) }}</p>
                </div>

                @if($appointment->cancellation_reason)
                    <div class="rounded-3xl border border-rose-500/20 bg-rose-500/10 p-5">
                        <p class="text-sm font-semibold text-rose-200">{{ __('Cancellation Reason') }}</p>
                        <p class="mt-2 text-sm text-rose-100">{{ $appointment->cancellation_reason }}</p>
                    </div>
                @endif

                <div class="flex justify-end">
                    <a href="{{ route('appointments.index') }}" class="btn-primary">{{ __('Back to appointments') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
