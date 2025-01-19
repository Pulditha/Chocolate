<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use app\Http\Controllers\Auth\RegisterController;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
    }
}; ?>
<html>
    <head> 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        @livewireStyles
    </head>
<div>
    @section('page-title', 'Login')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-brown-600" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-brown-800" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full " type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-brown-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-brown-800" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full border-brown-300 focus:ring-brown-500 focus:border-brown-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-brown-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-brown-300 text-brown-600 shadow-sm focus:ring-brown-500">
                <span class="ms-2 text-sm text-brown-800">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end mt-4 space-x-3">
            @if (Route::has('password.request'))
                <a class="underline font-anton text-sm text-brown-600 hover:text-brown-800 focus:ring-brown-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a class="mx-4 font-anton underline text-sm text-brown-600 hover:text-brown-800 focus:ring-brown-500" href="{{ route('register') }}" wire:navigate>
                {{ __('Don’t have an account?') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
</html>