<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;


new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>
<div class="card-body">
    <h5 class="card-header mb-4">Change Password</h5>
    <form wire:submit="updatePassword">
        <div class="row">
            <div class="mb-3 col-md-6 offset-3 form-password-toggle">
                <label class="form-label" for="currentPassword">
                    Current Password
                </label>
                <div class="input-group input-group-merge">
                    <input
                        class="form-control"
                        type="password"
                        name="currentPassword"
                        autocomplete="off"
                        wire:model="current_password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                    <span class="input-group-text cursor-pointer"
                        ><i class="bx bx-hide"></i
                    ></span>
                </div>
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6 offset-3 form-password-toggle">
                <label class="form-label" for="newPassword">
                    New Password
                </label>
                <div class="input-group input-group-merge">
                    <input
                        class="form-control"
                        type="password"
                        id="newPassword"
                        autocomplete="off"
                        wire:model="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                    <span class="input-group-text cursor-pointer"
                        ><i class="bx bx-hide"></i
                    ></span>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 col-md-6 offset-3 form-password-toggle">
                <label class="form-label" for="confirmPassword">
                    Confirm New Password
                </label>
                <div class="input-group input-group-merge">
                    <input
                        class="form-control"
                        type="password"
                        name="confirmPassword"
                        autocomplete="off"
                        wire:model="password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                    <span class="input-group-text cursor-pointer"
                        ><i class="bx bx-hide"></i
                    ></span>
                </div>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 offset-3 mt-1 d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-2">
                    <span wire:loading.remove wire:target='updatePassword'>
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Save changes
                    </span>
                    <span wire:loading wire:target='updatePassword'>
                        <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                        Loading
                    </span>
                </button>
                <div x-data="{ shown: false, timeout: null }"
                    x-init="@this.on('password-updated', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                    x-show.transition.out.opacity.duration.1500ms="shown"
                    x-transition:leave.opacity.duration.1500ms
                    style="display: none"
                >
                    <span class="badge badge-center rounded-pill bg-success"><i class="fa-solid fa-check"></i></span> Password successfully saved
                </div>
            </div>
        </div>
    </form>
</div>
