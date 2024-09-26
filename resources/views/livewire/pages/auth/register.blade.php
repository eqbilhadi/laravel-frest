<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.base')] #[Title('Register')] class extends Component {
    public string $firstname = '';
    public string $lastname = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'min:3', 'max:255', 'unique:'. User::class . ',username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <h4 class="mb-2">Adventure starts here 🚀</h4>
    <p class="mb-4">Make your app management easy and fun!</p>

    <form wire:submit="register">
        <div class="mb-3">
            <label for="firstname" class="form-label">Firstname</label>
            <input
                wire:model="firstname"
                type="text"
                class="form-control @error('firstname') is-invalid @enderror"
                id="firstname"
                name="firstname"
                placeholder="Enter your firstname"
                autofocus
            />
            @error('firstname')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input
                wire:model="lastname"
                type="text"
                class="form-control @error('lastname') is-invalid @enderror"
                id="lastname"
                name="lastname"
                placeholder="Enter your lastname"
                autofocus
            />
            @error('lastname')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                wire:model="username"
                type="text"
                class="form-control @error('username') is-invalid @enderror"
                id="username"
                name="username"
                placeholder="Enter your username"
                autocomplete="username"
                autofocus
            />
            @error('username')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                wire:model="email"
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                placeholder="Enter your email"
            />
            @error('email')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
                <input
                    wire:model="password"
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    autocomplete="password"
                />
                <span class="input-group-text cursor-pointer"
                    ><i class="bx bx-hide"></i
                ></span>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group input-group-merge">
                <input
                    wire:model="password_confirmation"
                    type="password"
                    id="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    autocomplete="password-confirmation"
                />
                <span class="input-group-text cursor-pointer"
                    ><i class="bx bx-hide"></i
                ></span>
            </div>
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
        {{-- <div class="mb-3">
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="terms-conditions"
                    name="terms"
                />
                <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
            </div>
        </div> --}}
        <button class="btn btn-primary d-grid w-100">
            <span wire:loading.remove wire:target='register'>
                Register
                <i class="fa-solid fa-right-to-bracket ms-1"></i>
            </span>
            <span wire:loading wire:target='register'>
                <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                Loading
            </span>
        </button>
    </form>

    <p class="text-center mt-3">
        <span>Already have an account?</span>
        <a href="{{ route('login') }}" wire:navigate>
            <span>Sign in instead</span>
        </a>
    </p>
</div>
