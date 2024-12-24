<div
    class="modal fade"
    id="permissionModalForm"
    tabindex="-1"
    aria-hidden="true"
    x-data="{ isLoading: false }"
    x-on:open-permission-form.window="isLoading = true;"
    x-on:open-modal.window="isLoading = false;"
    wire:ignore.self
>
    <div
        class="modal-dialog modal-dialog-centered"
        x-show="!isLoading"
    >
        <div class="modal-content p-3 p-md-5">
            <button
                type="button"
                class="btn-close btn-pinned"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3>{{ Str::ucfirst($actionForm) }} Permission</h3>
                    <p>Permissions you may use and assign to your users.</p>
                </div>
                <form wire:submit="save">
                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Permission Name
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control auto-focus @error('form.name') is-invalid @enderror"
                            placeholder="Permission Name"
                            wire:model="form.name"
                            autofocus
                        />
                        @error('form.name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 mb-3" wire:ignore>
                        <label class="form-label">
                            Assigned To Role
                            <small class="text-muted">(optional)</small>
                        </label>
                        <div class="select2-dark">
                            <select
                                id="select2Basic"
                                class="select2 form-select"
                                wire:model="form.role"
                                multiple
                            >
                                @foreach ($options['roles'] as $role)
                                <option value="{{ $role['id'] }}">
                                    {{ $role["name"] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button
                            type="reset"
                            class="btn btn-label-secondary me-sm-3 me-1"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-dialog modal-dialog-centered" role="document" x-show="isLoading">
        <div class="modal-content">
            <div class="modal-body d-flex justify-content-center align-items-center" style="height: 418px;">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("livewire:navigated", () => {
            // Listening open modal
            Livewire.on("open-modal", (event) => {
                $("#permissionModalForm").modal("show");
            });

            // Initialize form modal focus when shown
            $("#permissionModalForm").on("shown.bs.modal", function (e) {
                $(".auto-focus").focus();
            });

            // Initialize select2
            const select2 = $(".select2");
            if (select2.length) {
                select2.each(function () {
                    var $this = $(this);
                    $this.select2({
                        placeholder: "Select role",
                        dropdownParent: $this.parent(),
                    });

                    $this.on("select2:select select2:unselect", function () {
                        var selectedValue = $(this).val();
                        @this.set('form.role', selectedValue, false);
                    });
                });
            }

            // Initialize multiple placeholder on select2
            $(".select2-search__field").css("width", "100%");

            // Listening load-select2
            Livewire.on("load-select2", (event) => {
                select2.val(event.role).trigger("change");
            });

            // Listening reset-select2
            Livewire.on("reset-select2", (event) => {
                select2.val(null).trigger("change");
            });

            // Initilize autofocus when select2 on click
            $(document).on("select2:open", () => {
                document.querySelector(".select2-search__field").focus();
            });
        }, { once: true });
    </script>
</div>
