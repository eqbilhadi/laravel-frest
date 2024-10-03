<?php

namespace Modules\Rbac\Livewire\Account;

use Livewire\Component;
use Modules\Authentication\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

class DeleteAccount extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('rbac::livewire.account.delete-account');
    }
}
