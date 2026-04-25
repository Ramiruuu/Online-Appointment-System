<x-guest-layout>
    <div class="app-card p-8">
        <div class="mb-4 text-sm leading-6 text-slate-300">
            {{ __('Thanks for signing up! Before getting started, please verify your email address using the link we just emailed to you. If you didn\'t receive it, we can send another one immediately.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 p-4 text-sm font-medium text-emerald-300">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-primary-button class="w-full sm:w-auto">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-slate-900/80 px-4 py-3 text-sm font-semibold text-slate-100 shadow-lg shadow-slate-950/20 hover:bg-slate-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
