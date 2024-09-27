<?php

use Modules\Authentication\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new class extends Component {

    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<x-authentication::layout.base title="Login">
    @volt('login')
        <div>
            <h4 class="mb-2">Welcome to Frest! 👋</h4>
            <p class="mb-4">
                Please sign-in to your account and start the adventure
            </p>
        
            <form wire:submit="login">
                <div class="mb-3">
                    <label for="email" class="form-label">
                        {{ __("Email or Username") }}
                    </label>
                    <input
                        wire:model="form.email"
                        type="text"
                        class="form-control @error('form.email') is-invalid @enderror"
                        id="email"
                        name="email-username"
                        placeholder="Enter your email or username"
                        autocomplete="username"
                        autofocus
                    />
                    @error('form.email')
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">
                            {{ __('Password') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate>
                                <small>{{ __("Forgot your password?") }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="input-group input-group-merge" x-data="{ show: false }">
                        <input
                            wire:model="form.password"
                            :type="show ? 'text' : 'password'"
                            id="password"
                            class="form-control @error('form.password') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                            autocomplete="current-password"
                        />
                        <span class="input-group-text cursor-pointer" @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </span>
                    </div>
                    @error('form.password')
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input
                            wire:model="form.remember"
                            class="form-check-input"
                            type="checkbox"
                            id="remember-me"
                        />
                        <label
                            class="form-check-label"
                            for="remember-me"
                        >
                            {{ __("Remember me") }}
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100">
                    <span wire:loading.remove wire:target='login'>
                        Login
                        <i class="fa-solid fa-right-to-bracket ms-1"></i>
                    </span>
                    <span wire:loading wire:target='login'>
                        <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                        Loading
                    </span>
                </button>
            </form>
        
            <p class="text-center mt-3">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}" wire:navigate>
                    <span>Create an account</span>
                </a>
            </p>
        </div>
    @endvolt
</x-authentication::layout.base>

