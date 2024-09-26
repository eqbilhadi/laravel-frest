<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->token = request()->route('token');

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<x-authentication::layout.base title="Reset Password">
    @volt('reset-password')
        <div>
            <h4 class="mb-2">Reset Password 🔒</h4>
            <p class="mb-4">for <span class="fw-bold">{{ $email }}</span></p>
            <form wire:submit="resetPassword">
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">
                        New Password
                    </label>
                    <div class="input-group input-group-merge">
                        <input
                            wire:model="password"
                            type="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror @error('email') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer">
                            <i class="bx bx-hide"></i>
                        </span>
                    </div>
                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">
                        Confirm Password
                    </label>
                    <div class="input-group input-group-merge">
                        <input
                            wire:model="password_confirmation"
                            type="password"
                            id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer">
                            <i class="bx bx-hide"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button class="btn btn-primary d-grid w-100 mb-3">
                    <span wire:loading.remove wire:target='resetPassword'>
                        <i class="fa-sharp fa-solid fa-arrows-retweet me-1"></i> 
                        Reset password
                    </span>
                    <span wire:loading wire:target='resetPassword'>
                        <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                        Loading
                    </span>
                </button>
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
            </form>
        </div>
    @endvolt
</x-authentication::layout.base>

