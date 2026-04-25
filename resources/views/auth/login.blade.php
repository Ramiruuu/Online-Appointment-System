<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-2 text-center">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-400">{{ __('Sign in') }}</p>
            <h2 class="text-3xl font-semibold text-white">{{ __('Welcome back') }}</h2>
            <p class="text-sm text-slate-400">{{ __('Access your appointments, manage bookings and stay organized.') }}</p>
        </div>

        <x-auth-session-status class="rounded-2xl bg-slate-950/80 border border-cyan-500/10 p-4 text-sm text-cyan-200" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" class="form-input mt-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <x-text-input id="password" class="form-input mt-2"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div class="flex items-center justify-between gap-4">
                <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-300">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-500 bg-slate-800 text-cyan-500 focus:ring-cyan-500" name="remember">
                    {{ __('Remember me') }}
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-cyan-300 hover:text-white" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <p class="text-center text-sm text-slate-400">{{ __('New here?') }} <a href="{{ route('register') }}" class="font-semibold text-cyan-300 hover:text-white">{{ __('Create an account') }}</a></p>
    </div>
</x-guest-layout>
