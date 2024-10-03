<div>
    <div class="card-body">
        <h5 class="card-header mb-4">Delete Account</h5>
        <div class="col-12 mb-0">
            <div class="alert alert-warning">
                <h6 class="alert-heading mb-1">
                    Are you sure you want to delete your account?
                </h6>
                <p class="mb-0">
                    Once you delete your account, there is no going back. Please be
                    certain.
                </p>
            </div>
        </div>
        <div x-data="{ isChecked: false }">
            <div class="form-check mb-3">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="accountActivation"
                    id="accountActivation"
                    x-model="isChecked"
                />
                <label class="form-check-label" for="accountActivation"
                    >I confirm deleting my account</label
                >
            </div>
            <button 
                type="button" 
                class="btn btn-danger deactivate-account" 
                :disabled="!isChecked"
                data-bs-toggle="modal"
                data-bs-target="#confirmDeleteAccountModal"
            >
                Delete Account
            </button>
        </div>
        <div wire:ignore.self class="modal fade" id="confirmDeleteAccountModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Are you sure you want to delete your account?</h5>
                    </div>
                    <form wire:submit="deleteUser">
                        <div class="modal-body">
                            Once you delete your account, there is no going back. Please be certain. <br>
                            Please enter your password to confirm you would like to permanently delete your account.
                            <input type="password" class="form-control mt-3" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" wire:model='password'>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn btn-danger">
                                <span wire:loading.remove wire:target='deleteUser'>
                                    Delete Account
                                </span>
                                <span wire:loading wire:target='deleteUser'>
                                    <i class="fa-duotone fa-spinner-third fa-spin me-1"></i>
                                    Loading
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
