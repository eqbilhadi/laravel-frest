<?php

namespace Modules\Rbac\Livewire\UserManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Authentication\App\Models\ComUser;
use Modules\Rbac\Livewire\Validations\UserValidation;
use Modules\Rbac\Services\Registration\User\UserRegistration;
use \Illuminate\Http\UploadedFile;
use Modules\Rbac\App\Models\ComRole;

class Form extends Component
{
    use WithFileUploads, UserValidation;

    public array $form = [
        'username' => '',
        'email' => '',
        'password' => '',
        'firstname' => '',
        'lastname' => '',
        'birthplace' => '',
        'birthdate' => '',
        'gender' => '',
        'avatar' => '',
        'phone' => '',
        'address' => '',
        'is_active' => '',
        'roles' => []
    ];

    public array $options = [];

    public ComUser $comUser;

    public string $actionForm = "Added";
    
    public function mount(?ComUser $comUser = null): void
    {
        $this->comUser = $comUser;

        if ($this->comUser->exists) {
            $this->fillForm();
            $this->actionForm = "Updated";
        }

        $this->options['roles'] = ComRole::latest()->get()->toArray();
    }
    
    #[Computed]
    public function avatarUser()
    {
        $avatar = $this->form['avatar'];
        $gender = $this->form['gender'];

        if ($avatar) {
            return $avatar instanceof UploadedFile 
                ? $avatar->temporaryUrl() 
                : asset($avatar);
        }

        return match($gender) {
            'l' => asset('assets/images/avatars/blank-avatar-man.jpg'),
            'p' => asset('assets/images/avatars/blank-avatar-woman.jpg'),
            default => asset('assets/images/avatars/blank-avatar.png'),
        };
    }

    public function removeAvatar()
    {
        $this->form['avatar'] = '';
    }

    public function fillForm()
    {
        $this->form = [
            'username' => $this->comUser->username,
            'email' => $this->comUser->email,
            'firstname' => $this->comUser->firstname,
            'lastname' => $this->comUser->lastname,
            'birthplace' => $this->comUser->birthplace,
            'birthdate' => $this->comUser->birthdate,
            'gender' => $this->comUser->gender,
            'avatar' => $this->comUser->avatar,
            'phone' => $this->comUser->phone,
            'address' => $this->comUser->address,
            'is_active' => $this->comUser->is_active,
            'roles' => $this->comUser->roles->pluck('id')->toArray()
        ];

    }

    public function save()
    {
        $this->validate();

        try {
            (new UserRegistration($this->form, $this->comUser))->handle();
            toastr()->closeButton(true)->addSuccess($this->actionForm. ' user successfully');
            return $this->redirect(route('rbac.user.index'), navigate: true);
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::error($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.user-management.form');
    }
}
