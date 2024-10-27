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
                                @foreach ($this->menus as $menu)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                @for ($i = 1; $i < $loop->depth; $i++)
                                                    <div class="align-self-center me-3">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                @endfor
                                                <div class="align-self-center me-3">
                                                    <i class="{{ $menu->icon }} fa-lg fa-fw"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="{{ $loop->depth === 1 ? 'fw-bold' : 'fw-semibold' }}">
                                                        {{ $menu->label_name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-dark d-flex justify-content-center"
                                                bis_skin_checked="1">
                                                <input class="form-check-input" type="checkbox" value="{{ $menu->id }}" id="customCheckSecondary" wire:model="navAccess" />
                                            </div>
                                        </td>
                                    </tr>
                                    @isset($menu->children)
                                        @foreach ($menu->children as $child)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        @for ($i = 1; $i < $loop->depth; $i++)
                                                            <div class="align-self-center me-3">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                        @endfor
                                                        <div class="align-self-center me-3">
                                                            <i class="{{ $child->icon }} fa-lg fa-fw"></i>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span
                                                                class="{{ $loop->depth === 1 ? 'fw-bold' : 'fw-semibold' }}">
                                                                {{ $child->label_name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-dark d-flex justify-content-center"
                                                        bis_skin_checked="1">
                                                        <input class="form-check-input" type="checkbox" value="{{ $child->id }}" id="customCheckSecondary"  wire:model="navAccess" />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
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
                    Save & Next
                </button>
            </div>
        </div>
    </form>
</div>
