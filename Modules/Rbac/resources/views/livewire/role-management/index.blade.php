<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Roles Table</h5>
                    <h6 class="card-subtitle text-muted">List of role</h6>
                </div>
                @can('role-create')
                    <div class="col-6 text-end">
                        <a
                            href="{{ route('rbac.role.create') }}"
                            wire:navigate
                            class="btn btn-primary"
                        >
                            <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                            <span class="d-none d-sm-block"> Add Roles </span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped border-top table-sm">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 3%;">No</th>
                        <th>Roles Name</th>
                        @canany(['role-edit', 'role-delete'])
                            <th class="text-end">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($roles as $role)
                        <tr wire:key="role-{{ $role->id }}">
                            <td class="text-center">
                                {{ $roles->firstItem() + $loop->index }}
                            </td>
                            <td class="fw-semibold">
                                <span class="badge m-1" style="background-color: {{ $role->color }};">
                                    <i class="{{ $role->icon }} me-1"></i>
                                    {{ $role->name }}
                                </span>
                            </td>
                            @canany(['role-edit', 'role-delete'])
                                <td class="text-end">
                                    @can('role-edit')
                                        <a
                                            href="{{ route('rbac.role.edit', $role->id) }}"
                                            class="btn btn-sm btn-warning"
                                            wire:navigate
                                        >
                                            Edit
                                        </a>
                                    @endcan
                                    @can('role-delete')
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-delete-id={{ "$role->id" }}
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
        {{ $roles->links() }}
    </div>

    <x-confirm-delete-modal />
</div>
