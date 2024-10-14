<div>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">
                        @if ($comMenu->exists) Edit @else Create @endif
                        Navigation
                    </h5>
                    <h6 class="card-subtitle text-muted">
                        Form to @if ($comMenu->exists) edit @else create @endif
                        a navigation
                    </h6>
                </div>
                <div class="col-6 text-end">
                    <a
                        href="{{ route('rbac.nav.index') }}"
                        class="btn btn-danger"
                        wire:navigate
                    >
                        <i class="fa-regular fa-circle-left fa-fw me-sm-1"></i>
                        <span class="d-none d-sm-block"> Back </span>
                    </a>
                </div>
            </div>
        </div>
        <div
            class="card-body border-top"
            x-data="{ isDisabledDivider: !($wire.form.parent_id == '') }"
            x-effect="if (isDisabledDivider) { $wire.form.is_divider = '0' } else { $wire.form.is_divider = '0' }"
            x-on:reseted-form.window="
                isDisabledDivider = $event.detail.is_divider;
            "
        >
            <form wire:submit.prevent="save">
                <div class="row mb-3">
                    <label
                        class="col-sm-2 col-form-label text-sm-end"
                        for="Icon"
                        >Icon</label
                    >
                    <div class="col-sm-10">
                        <input
                            type="text"
                            class="form-control"
                            id="Icon"
                            placeholder="Icon base from https://fontawesome.com/icons"
                            autofocus
                            wire:model="form.icon"
                        />
                        @error('form.icon')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label
                        class="col-sm-2 col-form-label text-sm-end"
                        for="parent"
                        >Nav Parent</label
                    >
                    <div class="col-sm-10">
                        <select
                            id="parent"
                            class="form-select"
                            x-on:change="isDisabledDivider = !($event.target.value == '')"
                            wire:model="form.parent_id"
                        >
                            <option value="">Main Nav</option>
                            @foreach ($options['parents_nav'] as $nav)
                            <option value="{{ $nav['id'] }}">
                                {{ $nav["label_name"] }}
                            </option>
                            @endforeach
                        </select>
                        @error('form.parent_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label
                        class="col-sm-2 col-form-label text-sm-end"
                        for="label"
                        >Nav Label</label
                    >
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input
                                type="text"
                                id="label"
                                class="form-control"
                                placeholder="Nav label"
                                wire:model="form.label_name"
                            />
                        </div>
                        @error('form.label_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label
                        class="col-sm-2 col-form-label text-sm-end"
                        for="controller-classname"
                        >Controller Classname</label
                    >
                    <div class="col-sm-10">
                        <input
                            type="text"
                            id="controller-classname"
                            class="form-control phone-mask"
                            placeholder="The name of the controller that handles the navigation"
                            wire:model="form.controller_name"
                        />
                        @error('form.controller_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label
                        class="col-sm-2 col-form-label text-sm-end"
                        for="route-name"
                        >Route Name</label
                    >
                    <div class="col-sm-10">
                        <input
                            type="text"
                            id="route-name"
                            class="form-control"
                            placeholder="The name of the route that handles the navigation"
                            wire:model="form.route_name"
                        />
                        @error('form.route_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-sm-end" for="url"
                        >Url</label
                    >
                    <div class="col-sm-10">
                        <input
                            type="text"
                            id="url"
                            class="form-control"
                            placeholder="The url that handles the navigation"
                            wire:model="form.url"
                        />
                        @error('form.url')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-sm-end"
                        >Status</label
                    >
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline mt-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="active"
                                value="1"
                                wire:model="form.is_active"
                            />
                            <label class="form-check-label" for="active"
                                >Active</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="inactive"
                                value="0"
                                wire:model="form.is_active"
                            />
                            <label class="form-check-label" for="inactive"
                                >Inactive</label
                            >
                        </div>
                        @error('form.is_active')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-sm-end"
                        >Is Divider Nav</label
                    >
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline mt-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="divider"
                                id="yes"
                                value="1"
                                wire:model="form.is_divider"
                                :disabled="isDisabledDivider"
                            />
                            <label class="form-check-label" for="yes"
                                >Yes</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="divider"
                                id="no"
                                value="0"
                                wire:model="form.is_divider"
                                :disabled="isDisabledDivider"
                            />
                            <label class="form-check-label" for="no">No</label>
                        </div>
                        @error('form.is_divider')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button
                            type="button"
                            class="btn btn-light mt-3 me-2"
                            wire:click="resetForm"
                            wire:loading.attr="disabled"
                            wire:target="resetForm"
                        >
                            <span wire:loading.remove wire:target="resetForm">
                                <i class="fa-regular fa-rotate-left me-1"></i>
                                Reset
                            </span>
                            <span wire:loading wire:target="resetForm">
                                <i
                                    class="fa-solid fa-spinner-third fa-spin"
                                    style="--fa-animation-duration: 0.7s"
                                ></i>
                                Reset
                            </span>
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary mt-3"
                            wire:loading.attr="disabled"
                            wire:target="save"
                        >
                            <span wire:loading.remove wire:target="save">
                                <i class="fa-regular fa-floppy-disk me-1"></i>
                                Save
                            </span>
                            <span wire:loading wire:target="save">
                                <i
                                    class="fa-solid fa-spinner-third fa-spin"
                                    style="--fa-animation-duration: 0.7s"
                                ></i>
                                Save
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
