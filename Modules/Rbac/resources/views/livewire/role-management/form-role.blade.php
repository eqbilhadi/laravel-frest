<div>
    <form wire:submit="save">
        <div id="account-details-vertical" class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="content-header mb-3">
                    <h6 class="mb-0">Role Details</h6>
                    <small>Enter Your Role Details.</small>
                </div>
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label class="form-label">
                            Role Name
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Enter Role Name"
                            wire:model="form.name"
                            autofocus
                        />
                        @error('form.name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-10 form-password-toggle">
                        <label class="form-label">
                            Icon Role
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Enter Role Icon"
                            wire:model="form.icon"
                        />
                        @error('form.icon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">
                            Color Role
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="color"
                            class="form-control"
                            style="height: 39px !important;"
                            wire:model="form.color"
                        />
                        @error('form.color')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Save & Next</button>
            </div>
        </div>
    </form>
</div>
