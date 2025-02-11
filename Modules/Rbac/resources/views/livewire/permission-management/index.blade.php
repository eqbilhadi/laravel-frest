<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Permissions Table</h5>
                    <h6 class="card-subtitle text-muted">List of permission</h6>
                </div>
                <div class="col-6 text-end">
                    @can('permission-create')
                        <button
                            class="btn btn-primary"
                            x-on:click="$dispatch('open-permission-form')"
                            data-bs-toggle="modal"
                            data-bs-target="#permissionModalForm"
                        >
                            <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                            <span class="d-none d-sm-block"> Add Permissions </span>
                        </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped border-top table-sm">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 3%;">No</th>
                        <th>Permissions Name</th>
                        <th>Assigned To</th>
                        @canany(['permission-edit', 'permission-delete'])
                            <th class="text-end">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($permissions as $permission)
                        <tr wire:key="permission-{{ $permission->id }}">
                            <td class="text-center">
                                {{ $permissions->firstItem() + $loop->index }}
                            </td>
                            <td>
                                {{ $permission->name }}
                            </td>
                            <td>
                                @foreach ($permission->roles as $role)
                                    <span class="badge m-1" style="background-color: {{ $role->color }};">
                                        @if ($role->icon != null)
                                            <i class="{{ $role->icon }}"></i>
                                        @endif
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            @canany(['permission-edit', 'permission-delete'])
                                <td class="text-end">
                                    @can('permission-edit')
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#permissionModalForm"
                                            x-on:click="$dispatch('open-permission-form', { comPermission: {{ $permission }} })"
                                        >
                                            Edit
                                        </button>
                                    @endcan
                                    @can('permission-delete')
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-delete-id={{ "$permission->id" }}
                                        >
                                            Delete
                                        </button>
                                    @endcan
                                </td>
                            @endcanany
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
        {{ $permissions->links() }}
    </div>
    <livewire:rbac::permission-management.modal-form />
    <x-confirm-delete-modal />

    <script>
        document.addEventListener("livewire:navigated", () => {
            // Listening close modal
            Livewire.on("close-modal", (event) => {
                $("#permissionModalForm").modal("hide");
            });
        }, { once: true });
    </script>
</div>
