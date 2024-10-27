<div>
    <form wire:submit="save">
        <div id="account-details-vertical" class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="content-header mb-3">
                    <h6 class="mb-0">Navigation Access for Role</h6>
                    <small>Enter Your Navigation Access for Role.</small>
                </div>
                <div class="row g-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm border-top">
                            <thead>
                                <th>Navigation Name</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($this->permissions as $permission)
                                    <tr>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-dark d-flex justify-content-center"
                                                bis_skin_checked="1">
                                                <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="customCheckSecondary" wire:model="permissionAccess" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">
                    Save & Finish
                </button>
            </div>
        </div>
    </form>
</div>
