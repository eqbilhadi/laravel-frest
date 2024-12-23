<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Navigation Table</h5>
                    <h6 class="card-subtitle text-muted">List of navigation menu</h6>
                </div>
                @can('create-navigation')
                    <div class="col-6 text-end">
                        <a href="{{ route('rbac.nav.create') }}" class="btn btn-primary" wire:navigate>
                            <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                            <span class="d-none d-sm-block">
                                Add Navigation
                            </span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped border-top table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Navigation Label Name</th>
                        <th>Controller Name</th>
                        <th class="text-center">Status</th>
                        @canany(['sort-navigation', 'edit-navigation', 'delete-navigation'])
                            <th class="text-end">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($navs as $nav)
                        <x-rbac::menu-item :menu="$nav" :$loop />
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">Data Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <x-confirm-delete-modal />
</div>
