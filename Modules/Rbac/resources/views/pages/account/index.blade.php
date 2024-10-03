<x-layouts.app.base>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home"
                            aria-controls="navs-pills-justified-home"
                            aria-selected="true"
                        >
                            <i class="fa-solid fa-address-card me-1 fa-fw"></i> Profile
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile"
                            aria-controls="navs-pills-justified-profile"
                            aria-selected="false"
                        >
                            <i class="fa-sharp fa-solid fa-lock-keyhole me-1 fa-fw"></i> Update Password
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-messages"
                            aria-controls="navs-pills-justified-messages"
                            aria-selected="false"
                        >
                            <i class="fa-solid fa-trash me-1 fa-fw"></i>
                            Delete Account
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div
                        class="tab-pane fade show active"
                        id="navs-pills-justified-home"
                        role="tabpanel"
                    >
                        <livewire:rbac::account.profile />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="navs-pills-justified-profile"
                        role="tabpanel"
                    >
                        <livewire:rbac::account.password />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="navs-pills-justified-messages"
                        role="tabpanel"
                    >
                        <livewire:rbac::account.delete-account />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.base>
