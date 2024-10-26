<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Permissions Table</h5>
                    <h6 class="card-subtitle text-muted">List of permission</h6>
                </div>
                <div class="col-6 text-end">
                    <button
                        class="btn btn-primary"
                        x-on:click="$dispatch('open-permission-form')"
                        data-bs-toggle="modal"
                        data-bs-target="#permissionModalForm"
                    >
                        <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                        <span class="d-none d-sm-block"> Add Permissions </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped border-top">
                <thead class="table-dark">
                    <tr>
                        <th>Permissions Name</th>
                        <th>Assigned To</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($permissions as $permission)
                        <tr wire:key="permission-{{ $permission->id }}">
                            <td class="fw-semibold">{{ $permission->name }}</td>
                            <td>
                                @foreach ($permission->roles as $role)
                                    <span class="badge bg-primary m-1">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-end">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#permissionModalForm"
                                    x-on:click="$dispatch('open-permission-form', { comPermission: {{ $permission }} })"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-delete-id={{ "$permission->id" }}
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">
                                Data Not Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <livewire:rbac::permission-management.modal-form />
    <x-confirm-delete-modal />

    <script>
        document.addEventListener("livewire:navigated", () => {
            // Listening close modal
            Livewire.on("close-modal", (event) => {
                $("#permissionModalForm").modal("hide");
            });
        });
    </script>
</div>
