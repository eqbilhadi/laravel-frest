<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Users Table</h5>
                    <h6 class="card-subtitle text-muted">List of user</h6>
                </div>
                @can('user-create')
                    <div class="col-6 text-end">
                        <a
                            href="{{ route('rbac.user.create') }}"
                            wire:navigate
                            class="btn btn-primary"
                        >
                            <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                            <span class="d-none d-sm-block"> Add User </span>
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
                        <th>Fullname</th>
                        <th>Account Info</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Status</th>
                        @canany('user-edit', 'user-delete')
                            <th class="text-end">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td class="text-center">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td>
                                <div class="d-flex overflow-hidden align-items-center">
                                    <div class="flex-shrink-0 avatar">
                                        <img 
                                            src="{{ $user->avatar_url }}" 
                                            alt="Avatar {{ $user->username }}" class="rounded-circle" 
                                        >
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="m-0">{{ $user->fullname }}</h6>
                                        <small class="user-status text-muted">{{ $user->main_role }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <li class="d-flex align-items-center">
                                    <i class="fa-regular fa-envelope me-2"></i>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa-regular fa-circle-user me-2"></i>
                                    <span>{{ $user->username }}</span>
                                </li>
                            </td>
                            <td class="text-center">
                                @if ($user->gender == 'l')
                                    <span class="badge rounded-pill bg-primary">
                                        <i class="fa-regular fa-mars me-1"></i>
                                        Male
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-danger">
                                        <i class="fa-regular fa-venus me-1"></i>
                                        Female
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge @if ($user->is_active == 1) bg-success @else bg-danger @endif">
                                    <span wire:loading.remove wire:target="changeStatus('{{ $user->id }}')">
                                        @if ($user->is_active)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </span>
                                </span>
                            </td>
                            @canany('user-edit', 'user-delete')
                                <td class="text-end">
                                    @can('user-edit')
                                        <a
                                            href="{{ route('rbac.user.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning"
                                            wire:navigate
                                        >
                                            Edit
                                        </a>
                                    @endcan
                                    @can('user-delete')
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-delete-id={{ "$user->id" }}
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
        {{ $users->links() }}
    </div>

    <x-confirm-delete-modal />
</div>
