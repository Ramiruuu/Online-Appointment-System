<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-2 text-center">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-400">{{ __('Create account') }}</p>
            <h2 class="text-3xl font-semibold text-white">{{ __('Register for access') }}</h2>
            <p class="text-sm text-slate-400">{{ __('Join now to manage your appointments and services.') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" class="form-label" />
                <x-text-input id="name" class="form-input mt-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" class="form-input mt-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone')" class="form-label" />
                <x-text-input id="phone" class="form-input mt-2" type="text" name="phone" :value="old('phone')" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <x-text-input id="password" class="form-input mt-2" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                <x-text-input id="password_confirmation" class="form-input mt-2" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-rose-400" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full btn-primary">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <p class="text-center text-sm text-slate-400">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="font-semibold text-cyan-300 hover:text-white">{{ __('Sign in') }}</a></p>
        </form>
    </div>
</x-guest-layout>
