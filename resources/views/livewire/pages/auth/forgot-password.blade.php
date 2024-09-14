<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.auth.base')] #[Title('Forgot Password')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>
<div>
    <h4 class="mb-2">Forgot Password? 🔒</h4>
    <p class="mb-4">
        Enter your email and we'll send you instructions to reset your password
    </p>
    <form wire:submit="sendPasswordResetLink">
        @if (session('status'))
            <div class="alert alert-solid-primary alert-dismissible d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-info me-3"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input wire:model="email" type="text" class="form-control" id="email" name="email"
                placeholder="Enter your email" autofocus />
            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <button class="btn btn-primary d-grid w-100">
            <span wire:loading.remove wire:target='sendPasswordResetLink'>
                <i class="fa-solid fa-paper-plane me-1"></i>
                Send Reset Link
            </span>
            <span wire:loading wire:target='sendPasswordResetLink'>
                <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                Loading
            </span>
        </button>
    </form>
    <div class="text-center mt-3">
        <a 
            href="{{ route('login') }}" 
            class="d-flex align-items-center justify-content-center" 
            wire:navigate
        >
            <i class="fa-solid fa-chevron-left me-2 fa-xs"></i>
            Back to login
        </a>
    </div>
</div>
