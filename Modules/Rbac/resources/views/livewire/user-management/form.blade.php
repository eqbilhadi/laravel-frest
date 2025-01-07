<div>
    <style>
        .profile-user .profile-photo-edit {
            position: absolute;
            right: 0;
            left: auto;
            bottom: 0;
            cursor: pointer;
        }

        .profile-user {
            position: relative;
            display: inline-block;
        }

        .avatar-title {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: #5ea3cb;
            color: #fff;
            display: flex;
            font-weight: 500;
            height: 100%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 100%;
        }

        .avatar-2xl {
            width: 6.5rem;
            height: 6.5rem;
        }
    </style>
    <div class="card h-100">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">
                        @if ($comUser->exists) Edit @else Create @endif User
                    </h5>
                    <h6 class="card-subtitle text-muted">
                        Form to @if ($comUser->exists) edit @else create @endif
                        a user
                    </h6>
                </div>
                <div class="col-6 text-end">
                    <a
                        href="{{ route('rbac.user.index') }}"
                        class="btn btn-danger"
                        wire:navigate
                    >
                        <i class="fa-regular fa-circle-left fa-fw me-sm-1"></i>
                        <span class="d-none d-sm-block"> Back </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body border-top py-0">
            <form wire:submit="save">
                <div class="row g-md-5">
                    <div class="col-md-4 col-12 text-center">
                        <div
                            class="profile-user position-relative d-inline-block mb-4 mt-3"
                        >
                            <img
                                src="{{ $this->avatarUser }}"
                                class="rounded-circle avatar-2xl img-thumbnail user-profile-image"
                                alt="user-profile-image"
                                wire:loading.class="d-none"
                                wire:target="form.avatar"
                                style="object-fit: cover"
                            />
                            <div
                                class="rounded-circle avatar-2xl img-thumbnail user-profile-image bg-light align-items-center d-flex justify-content-center d-none"
                                wire:loading.class.remove="d-none"
                                wire:target="form.avatar"
                            >
                                <i
                                    class="fa-duotone fa-spinner-third fa-spin fa-xl"
                                    style="--fa-animation-duration: 0.7s"
                                ></i>
                            </div>
                            <div
                                class="avatar-xs p-0 rounded-circle profile-photo-edit"
                            >
                                <input
                                    id="profile-img-file-input"
                                    type="file"
                                    class="profile-img-file-input d-none"
                                    wire:model="form.avatar"
                                />
                                @if ($form['avatar'] == null)
                                    <label
                                        for="profile-img-file-input"
                                        class="profile-photo-edit avatar-xs"
                                    >
                                        <span
                                            class="avatar-title rounded-circle bg-light text-body"
                                        >
                                            <i
                                                class="fa-regular fa-camera fa-sm fa-fw mt-1 text-black"
                                            ></i>
                                        </span>
                                    </label>
                                @else
                                    <label
                                        class="profile-photo-edit avatar-xs"
                                        wire:click="removeAvatar"
                                    >
                                        <span
                                            class="avatar-title rounded-circle bg-light text-body"
                                        >
                                            <i
                                                class="fa-regular fa-xmark fa-sm fa-fw mt-1 text-black"
                                            ></i>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        @error('form.avatar')
                            <small class="text-danger d-block mt-n3">{{ $message }}</small>
                        @enderror
                        <div class="mb-3 text-start w-100">
                            <label class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="example@email.com"
                                wire:model="form.email"
                            />
                            @error('form.email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 text-start w-100">
                            <label class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="username for the user login"
                                wire:model="form.username"
                            />
                            @error('form.username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 text-start w-100">
                            <label class="form-label">Password</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="password for the user login"
                                wire:model="form.password"
                            />
                            @error('form.password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 text-start w-100">
                            <label class="form-label">Role</label>
                            <div wire:ignore>
                                <select
                                    id="select2Basic"
                                    class="select2 form-select"
                                    wire:model="form.roles"
                                    multiple
                                >
                                    @foreach ($options['roles'] as $role)
                                        <option value="{{ $role['id'] }}">
                                            {{ $role["name"] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form.roles')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="row">
                            <div class="my-md-3 col-md-6">
                                <label for="firstName" class="form-label">
                                    First Name
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="firstName"
                                    name="firstName"
                                    wire:model="form.firstname"
                                    placeholder="enter user firstname"
                                />
                                @error('form.firstname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="my-3 col-md-6">
                                <label for="lastName" class="form-label">
                                    Last Name
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    wire:model="form.lastname"
                                    placeholder="enter user lastname"
                                />
                                @error('form.lastname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="birthPlace">
                                    Birthplace
                                </label>
                                <input
                                    type="text"
                                    id="birthPlace"
                                    name="birthPlace"
                                    class="form-control"
                                    wire:model="form.birthplace"
                                    placeholder="enter user birthplace"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthDate" class="form-label">
                                    Birthdate
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="birthDate"
                                    name="birthDate"
                                    wire:model="form.birthdate"
                                    placeholder="enter user birthdate"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">
                                    Phone
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    wire:model="form.phone"
                                    placeholder="enter user phone"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">
                                    Gender
                                </label>
                                <div class="col-md p-0">
                                    <div
                                        class="form-check form-check-inline mt-2"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="genderOptions"
                                            id="man"
                                            wire:model.live="form.gender"
                                            value="l"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="man"
                                            >Male</label
                                        >
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="genderOptions"
                                            id="woman"
                                            wire:model.live="form.gender"
                                            value="p"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="woman"
                                            >Female</label
                                        >
                                    </div>
                                </div>
                                @error('form.gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">
                                    Addresses
                                </label>
                                <textarea
                                    name="address"
                                    id="address"
                                    rows="7"
                                    class="form-control"
                                    wire:model="form.address"
                                    placeholder="enter user address"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("livewire:navigated", () => {
            $(".select2").select2({
                placeholder: "select role for the user",
            });

            $(".select2").on("select2:select select2:unselect", function () {
                var selectedValue = $(this).val();
                @this.set('form.roles', selectedValue, false);
            });
        }, { once: true });
    </script>
</div>
