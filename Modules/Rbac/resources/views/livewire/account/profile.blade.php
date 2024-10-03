<div>
    <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img
                src="{{ auth()->user()->avatar_url }}"
                alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar" 
            />
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 0" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                        type="file"
                        id="upload"
                        class="account-file-input"
                        hidden
                        wire:model='avatar'
                    />
                    </label>
                    <button type="button" class="btn btn-label-secondary account-image-reset mb-4" data-bs-toggle="modal" data-bs-target="#chooseAvatarModal">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Choose avatar</span>
                    </button>

                    <p class="mb-0" x-show="!isUploading">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" :style="'width: ' + progress + '%'" aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                <b x-text="progress + '%'"></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @error('avatar')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <hr class="my-3 mx-0" />
    <div class="card-body">
        <form wire:submit="updateProfileInformation">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input
                        class="form-control"
                        type="text"
                        id="firstName"
                        name="firstName"
                        wire:model='firstname'
                        autofocus
                    />
                    @error('firstname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input
                        class="form-control"
                        type="text"
                        name="lastName"
                        id="lastName"
                        wire:model='lastname'
                    />
                    @error('lastname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                        class="form-control"
                        type="text"
                        id="email"
                        name="email"
                        wire:model='email'
                        placeholder="john.doe@example.com"
                    />
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">
                        Username
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Username"
                        wire:model='username'
                    />
                    @error('username')
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
                        placeholder="Birth place"
                        wire:model='birthplace'
                    />
                    @error('birthplace')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                    <label for="birthDate" class="form-label">Birthdate</label>
                    <input
                        type="date"
                        class="form-control"
                        id="birthDate"
                        name="birthDate"
                        placeholder="Address"
                        wire:model='birthdate'
                    />
                    @error('birthdate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input
                        class="form-control"
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="Phone number"
                        wire:model='phone'
                    />
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="zipCode" class="form-label">Gender</label>
                    <div class="col-md p-0">
                        <div class="form-check form-check-inline mt-2">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="genderOptions"
                            id="man"
                            wire:model='gender'
                            value="l" />
                          <label class="form-check-label" for="man">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="genderOptions"
                            id="woman"
                            wire:model='gender'
                            value="p" />
                          <label class="form-check-label" for="woman">Female</label>
                        </div>
                    </div>
                    @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">Addresses</label>
                    <textarea 
                        name="address" 
                        id="address" 
                        rows="5"
                        class="form-control"
                        wire:model='address'
                        placeholder="Address"
                    >
                    </textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-2 d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-2">
                    <span wire:loading.remove wire:target='updateProfileInformation'>
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Save changes
                    </span>
                    <span wire:loading wire:target='updateProfileInformation'>
                        <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                        Loading
                    </span>
                </button>
                <div x-data="{ shown: false, timeout: null }"
                    x-init="@this.on('profile-updated', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                    x-show.transition.out.opacity.duration.1500ms="shown"
                    x-transition:leave.opacity.duration.1500ms
                    style="display: none"
                >
                    <span class="badge badge-center rounded-pill bg-success"><i class="fa-solid fa-check"></i></span> Successfully saved
                </div>
            </div>
        </form>
    </div>

    <div wire:ignore.self class="modal fade" id="chooseAvatarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 1; $i <= 20; $i++)
                                <div class="col-md-3 mb-2">
                                    <div 
                                        class="form-check custom-option custom-option-image custom-option-image-radio" 
                                        wire:click="chooseAvatar('assets/images/avatars/{{ $i }}.png')"
                                    >
                                        <label class="form-check-label custom-option-content" for="customRadioImg{{ $i }}">
                                            <span class="custom-option-body">
                                                <img src="{{ asset('assets/images/avatars/'.$i.'.png') }}" alt="radioImg" />
                                            </span>
                                        </label>
                                        <input
                                            wire:model='avatar' 
                                            name="customRadioImage" 
                                            class="form-check-input" 
                                            type="radio"
                                            value="assets/images/avatars/{{ $i }}.png" 
                                            id="customRadioImg{{ $i }}"
                                        />
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('profile-updated', (event) => {
                $('#chooseAvatarModal').modal('hide');
            });
        })
    </script>
</div>