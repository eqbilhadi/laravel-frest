<div>
    <div class="col-12">
        <div
            class="bs-stepper wizard-horizontal horizontal wizard-horizontal-icons-example"
        >
            <div
                class="px-4 py-3 d-flex justify-content-between align-items-center border-bottom"
            >
                <div>
                    <h5 class="card-title">
                        @if ($actionForm == "Updated") Edit @else Create @endif Role
                    </h5>
                    <h6 class="card-subtitle text-muted mt-2">
                        Form to @if ($actionForm == "Updated") edit @else create @endif
                        a role
                    </h6>
                </div>
                <div>
                    <a
                        href="{{ route('rbac.role.index') }}"
                        class="btn btn-danger"
                        wire:navigate
                    >
                        <i class="fa-regular fa-circle-left fa-fw me-sm-1"></i>
                        <span class="d-none d-sm-block"> Back </span>
                    </a>
                </div>
            </div>
            <div class="bs-stepper-header">
                @foreach ($tabs as $key => $tab)
                    <div 
                        data-target="#{{ $tab['name'] }}"
                        @class([
                            'step', 
                            'active' => $tab['name'] === $currentTab['name'], 
                            // 'crossed' => $key < array_search($currentTab['name'], array_column($tabs, 'name'))
                        ])
                    >
                        <button
                            type="button"
                            class="step-trigger"
                            wire:click.prevent="setCurrentTab('{{ $tab['name'] }}')"
                            wire:loading.attr="disabled"
                            @disabled(!$loop->first && !$comRole->exists)
                        >
                            <span class="bs-stepper-circle">
                                <i class="{{ $tab['icon'] }}"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">
                                    {{ Str::of($tab['title'])->explode(' ')->first() }}
                                </span>
                                <span class="bs-stepper-subtitle">
                                    {{ $tab["title"] }}
                                </span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                @endforeach
            </div>
            <div class="bs-stepper-content">
                <div wire:loading.class="d-none">
                    @livewire($currentTab['view'], ['comRole' => $comRole,
                    "actionForm" => $actionForm], key($currentTab['name']))
                </div>

                <div
                    class="d-flex justify-content-center d-none"
                    wire:loading.class.remove="d-none"
                >
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
