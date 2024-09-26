<?php

use Modules\Authentication\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/login', navigate: true);
    }
}; ?>

<li 
    class="nav-item navbar-dropdown dropdown-user dropdown"
    x-data="{{ json_encode(['name' => auth()->user()->fullname, "avatar" => auth()->user()->avatar_url, "open" => false]) }}"
    x-on:profile-updated.window="
        name = $event.detail.name; 
        avatar = $event.detail.avatar
    "
>
    <a
        @click="open = ! open"
        class="nav-link dropdown-toggle hide-arrow" :class="{'show': open, '': ! open }"
        href="javascript:void(0);"
    >
        <div class="avatar avatar-online">
            <img
                :src="avatar"
                alt
                class="rounded-circle"
            />
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" :class="{'show': open, '': ! open }" data-bs-popper="false">
        <li>
            <a class="dropdown-item" href="pages-account-settings-account.html">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img
                                :src="avatar"
                                alt
                                class="rounded-circle"
                            />
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-semibold d-block lh-1" x-text="name"></span>
                        <small>Admin</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('account') }}" wire:navigate>
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">My Profile</span>
            </a>
        </li>
        <li>
            <a
                class="dropdown-item"
                wire:click="logout"
                role="button"
            >
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
            </a>
        </li>
    </ul>
</li>
