<?php

namespace Modules\Rbac\Livewire\Account;

use Livewire\Component;
use Modules\Authentication\App\Models\ComUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public ?string $username = '';
    public ?string $email = '';
    public ?string $firstname = '';
    public ?string $lastname = '';
    public ?string $birthplace = '';
    public ?string $birthdate = '';
    public ?string $gender = '';
    public $avatar;
    public ?string $phone = '';
    public ?string $address = '';

    /**
     * Method mount
     *
     * @return void
     */
    public function mount(): void
    {
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->firstname = Auth::user()->firstname;
        $this->lastname = Auth::user()->lastname;
        $this->birthplace = Auth::user()->birthplace;
        $this->birthdate = Auth::user()->birthdate;
        $this->gender = Auth::user()->gender;
        $this->phone = Auth::user()->phone;
        $this->address = Auth::user()->address;
    }

    /**
     * Method updateProfileInformation
     *
     * @return void
     */
    public function updateProfileInformation(): void
    {
        /** @var Modules\Authentication\App\Models\ComUser */
        $user = Auth::user();

        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'lowercase', Rule::unique(ComUser::class, 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(ComUser::class, 'email')->ignore($user->id)],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthplace' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255', 'date'],
            'gender' => ['required', 'in:l,p'],
            'avatar' => ['nullable', 'image'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        if ($this->avatar !== null && $this->avatar !== '') {
            // delete avatar user if exist in database and file
            if ($user->avatar != null && str_contains($user->avatar, 'user-avatars') && file_exists($user->avatar)) {
                unlink($user->avatar);
            }

            $validated['avatar'] = $this->avatar->store('assets/images/user-avatars', 'public_upload');
        }

        $filteredData = array_filter($validated, function ($value) {
            return !is_null($value) && $value !== '';
        });

        $user->fill($filteredData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->fullname, avatar: $user->avatar_url);
    }

    public function chooseAvatar($value)
    {
        /** @var Modules\Authentication\App\Models\ComUser */
        $user = Auth::user();

        if (
            $user->avatar != null
            && str_contains($user->avatar, 'user-avatars')
            && Storage::disk('public_upload')->exists($user->avatar)
        ) {
            Storage::disk('public_upload')->delete($user->avatar);
        }

        $user->update([
            'avatar' => $value
        ]);

        $this->reset('avatar');

        $this->dispatch('profile-updated', name: $user->fullname, avatar: $user->avatar_url);
    }

    public function render()
    {
        return view('rbac::livewire.account.profile');
    }
}
