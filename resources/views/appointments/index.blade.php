<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold tracking-tight text-white">{{ __('My Appointments') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            @if(session('success'))
                <div class="rounded-3xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm text-emerald-100">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-3xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm text-rose-100">{{ session('error') }}</div>
            @endif

            <div class="grid gap-6 xl:grid-cols-2">
                <section class="app-card p-8">
                    <h3 class="text-xl font-semibold text-white">{{ __('Upcoming Appointments') }}</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($upcoming as $appointment)
                            <article class="rounded-3xl border border-slate-700/80 bg-slate-950/70 p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-cyan-300">{{ $appointment->service->name }}</p>
                                        <p class="mt-2 text-sm text-slate-300">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'confirmed' ? 'bg-emerald-500/15 text-emerald-200' : 'bg-amber-500/15 text-amber-200' }}">{{ ucfirst($appointment->status) }}</span>
                                </div>
                                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <a href="{{ route('appointments.show', $appointment) }}" class="text-sm font-semibold text-cyan-300 hover:text-white">{{ __('View details') }}</a>
                                    @if(in_array($appointment->status, ['pending', 'confirmed']) && $appointment->appointment_date->isFuture())
                                        <details class="rounded-3xl border border-slate-700/80 bg-slate-900/90 p-4">
                                            <summary class="cursor-pointer text-sm font-semibold text-rose-400">{{ __('Cancel appointment') }}</summary>
                                            <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" class="mt-4 space-y-3">
                                                @csrf
                                                @method('DELETE')
                                                <div>
                                                    <label for="cancellation_reason_{{ $appointment->id }}" class="form-label">{{ __('Cancellation Reason') }}</label>
                                                    <textarea id="cancellation_reason_{{ $appointment->id }}" name="cancellation_reason" rows="3" class="form-input" placeholder="{{ __('Reason for cancellation') }}" required>{{ old('cancellation_reason') }}</textarea>
                                                    <x-input-error :messages="$errors->get('cancellation_reason')" class="mt-2 text-sm text-rose-400" />
                                                </div>
                                                <x-primary-button class="btn-primary w-full">{{ __('Submit cancellation') }}</x-primary-button>
                                            </form>
                                        </details>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <p class="text-sm text-slate-400">{{ __('You have no upcoming appointments.') }}</p>
                        @endforelse
                    </div>
                </section>

                <section class="app-card p-8">
                    <h3 class="text-xl font-semibold text-white">{{ __('Past Appointments') }}</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($past as $appointment)
                            <article class="rounded-3xl border border-slate-700/80 bg-slate-950/70 p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-cyan-300">{{ $appointment->service->name }}</p>
                                        <p class="mt-2 text-sm text-slate-300">{{ $appointment->appointment_date->format('F j, Y g:i A') }}</p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $appointment->status === 'completed' ? 'bg-blue-500/15 text-blue-200' : 'bg-slate-500/15 text-slate-200' }}">{{ ucfirst($appointment->status) }}</span>
                                </div>
                                @if($appointment->cancellation_reason)
                                    <p class="mt-4 text-sm text-slate-300"><strong>{{ __('Reason:') }}</strong> {{ $appointment->cancellation_reason }}</p>
                                @endif
                            </article>
                        @empty
                            <p class="text-sm text-slate-400">{{ __('You have no past appointments.') }}</p>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
