<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-3xl font-semibold tracking-tight text-white">{{ __('Dashboard') }}</h2>
                <p class="mt-2 text-sm text-slate-400">{{ __('A clean summary of your appointment activity and next actions.') }}</p>
            </div>
            <div class="inline-flex items-center gap-3 rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-sm text-slate-200 shadow-lg shadow-slate-950/30">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-cyan-500/10 text-cyan-300">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                <div>
                    <p class="font-semibold text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 xl:grid-cols-[320px_1fr]">
            <aside class="app-card p-6">
                <div class="mb-8">
                    <p class="text-xs uppercase tracking-[0.35em] text-cyan-300">{{ __('Menu') }}</p>
                    <h3 class="mt-4 text-2xl font-semibold text-white">{{ __('Workspace') }}</h3>
                </div>
                <nav class="space-y-2 text-sm text-slate-300">
                    <a href="{{ route('dashboard') }}" class="block rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 font-semibold text-white shadow-sm shadow-slate-950/20">{{ __('Dashboard') }}</a>
                    <a href="{{ route('appointments.index') }}" class="block rounded-2xl border border-transparent px-4 py-3 hover:border-white/10 hover:bg-slate-950/80">{{ __('Appointments') }}</a>
                    <a href="{{ route('appointments.create') }}" class="block rounded-2xl border border-transparent px-4 py-3 hover:border-white/10 hover:bg-slate-950/80">{{ __('Book Appointment') }}</a>
                    @if(auth()->user()->isAdmin())
                        <div class="mt-6 rounded-3xl border border-white/10 bg-slate-950/80 p-4">
                            <p class="text-xs uppercase tracking-[0.35em] text-cyan-300">{{ __('Admin') }}</p>
                            <a href="{{ route('admin.appointments.index') }}" class="mt-3 block rounded-2xl border border-transparent px-4 py-3 hover:border-white/10 hover:bg-slate-900">{{ __('Manage Appointments') }}</a>
                            <a href="{{ route('admin.services.index') }}" class="mt-2 block rounded-2xl border border-transparent px-4 py-3 hover:border-white/10 hover:bg-slate-900">{{ __('Manage Services') }}</a>
                        </div>
                    @endif
                </nav>
            </aside>

            <div class="space-y-6">
                <section class="grid gap-6 xl:grid-cols-3">
                    <article class="app-card p-6">
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">{{ __('Total appointments') }}</p>
                        <p class="mt-4 text-4xl font-semibold text-white">{{ $totalAppointments }}</p>
                        <p class="mt-2 text-sm text-slate-400">{{ __('All booked appointments in your account.') }}</p>
                    </article>

                    <article class="app-card p-6">
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">{{ __('Upcoming') }}</p>
                        <p class="mt-4 text-4xl font-semibold text-white">{{ $upcomingAppointments }}</p>
                        <p class="mt-2 text-sm text-slate-400">{{ __('Appointments scheduled in the future.') }}</p>
                    </article>

                    <article class="app-card p-6">
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">{{ __('Quick action') }}</p>
                        <a href="{{ route('appointments.create') }}" class="mt-4 inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20">{{ __('Book now') }}</a>
                        <a href="{{ route('appointments.index') }}" class="mt-3 inline-flex w-full items-center justify-center rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-sm font-semibold text-slate-100 hover:bg-slate-900">{{ __('Review appointments') }}</a>
                    </article>
                </section>

                <section class="app-card p-6">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">{{ __('Weekly schedule') }}</p>
                            <h3 class="mt-2 text-2xl font-semibold text-white">{{ __('Calendar snapshot') }}</h3>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl bg-slate-950/80 px-4 py-3 text-sm text-slate-300">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-cyan-500/10 text-cyan-300">{{ now()->format('M') }}</span>
                            <div>
                                <p class="font-semibold text-white">{{ now()->format('F j') }}</p>
                                <p class="text-xs text-slate-400">{{ __('Today') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/90 shadow-xl shadow-slate-950/20">
                        <div class="grid grid-cols-7 gap-px bg-slate-800/90 px-4 py-4 text-center text-[11px] uppercase tracking-[0.2em] text-slate-400">
                            @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                                <div>{{ $day }}</div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-7 gap-px bg-slate-900/90 p-4 text-center text-sm text-slate-300">
                            @foreach(range(1,7) as $day)
                                <div class="rounded-3xl bg-slate-900/80 py-4 shadow-inner shadow-slate-950/30">{{ now()->addDays($day - now()->dayOfWeek)->format('d') }}</div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-7 gap-px bg-slate-950/90 p-4 text-center text-slate-400 text-xs">
                            @foreach(range(1,7) as $day)
                                <div class="rounded-3xl bg-slate-900/80 py-3">{{ __('Open') }}</div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
