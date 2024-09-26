<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-authentication::layout.base title="Email Verification">
    @volt('verify-email')
        <div>
            @if (session('status') == 'verification-link-sent')
                <div
                    class="alert alert-solid-primary alert-dismissible d-flex align-items-center"
                    role="alert"
                >
                    <i class="fa-solid fa-circle-info me-3"></i>
                    A new verification link has been sent to the email address you provided during registration.
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    />
                </div>
            @endif

            <h4 class="mb-2">Verify your email ✉️</h4>
            <p class="text-start">
                Account activation link sent to your email address: hello@example.com
                Please follow the link inside to continue.
            </p>
            <a class="btn btn-primary w-100 my-3" href="{{ route('dashboard') }}"> Skip for now </a>
            <p class="text-center">
                Didn't get the mail?
                <a wire:click="sendVerification" href="javascript:void(0);"> 
                    <span wire:loading.remove wire:target='sendVerification'>
                        Resend
                    </span>
                    <span wire:loading wire:target='sendVerification'>
                        Waiting...
                    </span>
                </a>
            </p>
        </div>
    @endvolt
</x-authentication::layout.base>
