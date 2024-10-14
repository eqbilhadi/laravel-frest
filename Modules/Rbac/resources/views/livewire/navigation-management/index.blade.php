<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">Navigation Table</h5>
                    <h6 class="card-subtitle text-muted">List of navigation menu</h6>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('rbac.nav.create') }}" class="btn btn-primary" wire:navigate>
                        <i class="fa-regular fa-circle-plus fa-fw me-sm-1"></i>
                        <span class="d-none d-sm-block">
                            Add Navigation
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-sm border-top">
                <thead class="table-dark">
                    <tr>
                        <th>Navigation Label Name</th>
                        <th>Controller Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($navs as $nav)
                        <x-rbac::menu-item :menu="$nav" :$loop />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
