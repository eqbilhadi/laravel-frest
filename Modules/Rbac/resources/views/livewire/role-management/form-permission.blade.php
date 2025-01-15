<div>
    <style>
        .table-responsive::-webkit-scrollbar {
            width: 0px;
        }
        
        .table-responsive:hover::-webkit-scrollbar {
            width: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #888; 
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }
    </style>
    <form wire:submit="save">
        <div id="account-details-vertical" class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="content-header mb-3">
                    <h6 class="mb-0">Navigation Access for Role</h6>
                    <small>Enter Your Navigation Access for Role.</small>
                </div>
                <div class="row g-3">
                    <div class="table-responsive" style="height: 440px; overflow-y: auto;">
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
