<tr wire:key={{ $menu->id }}>
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
                <span class="text-sm text-muted">Route : {{ $menu->route_name ?? '-' }}</span>
                <span class="text-sm text-muted">Url : {{ $menu->url ?? '-' }}</span>
            </div>
        </div>
    </td>
    <td>{{ $menu->controller_name }}</td>
    <td class="text-center">
        <span class="badge @if ($menu->is_active == 1) bg-success @else bg-danger @endif">
            <span wire:loading.remove wire:target="changeStatus('{{ $menu->id }}')">
                @if ($menu->is_active == 1)
                    Active
                @else
                    Inactive
                @endif
            </span>
            <span wire:loading wire:target="changeStatus('{{ $menu->id }}')">
                <i class="fa-solid fa-spinner-third fa-spin" style="--fa-animation-duration: 0.7s;"></i>
            </span>
        </span>
        <button class="btn btn-icon btn-sm" wire:click="changeStatus('{{ $menu->id }}')">
            @if ($menu->is_active == 1)
                <i class="fa-sharp fa-solid fa-toggle-on fa-rotate-270"></i>
            @else
                <i class="fa-sharp fa-solid fa-toggle-off fa-rotate-270"></i>
            @endif
        </button>
    </td>
    <td class="text-end">
        <div class="d-flex flex-row justify-content-end align-items-center gap-2">
            <div class="d-flex flex-column">
                @unless ($loop->first)
                    <button data-bs-toggle="tooltip" title="Sort Up" class="btn btn-icon btn-sm" wire:click="changeOrder('{{ $menu->id }}','up')">
                        <span wire:loading.remove wire:target="changeOrder('{{ $menu->id }}','up')">
                            <i class="fa-solid fa-chevron-up"></i>
                        </span>
                        <span wire:loading wire:target="changeOrder('{{ $menu->id }}','up')">
                            <i class="fa-solid fa-spinner-third fa-spin" style="--fa-animation-duration: 0.7s;"></i>
                        </span>
                    </button>
                @endunless
                @unless ($loop->last)
                    <button data-bs-toggle="tooltip" title="Sort Down" class="btn btn-icon btn-sm" wire:click="changeOrder('{{ $menu->id }}','down')">
                        <span wire:loading.remove wire:target="changeOrder('{{ $menu->id }}','down')">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                        <span wire:loading wire:target="changeOrder('{{ $menu->id }}','down')">
                            <i class="fa-solid fa-spinner-third fa-spin" style="--fa-animation-duration: 0.7s;"></i>
                        </span>
                    </button>
                @endunless
            </div>
            <a href="{{ route('rbac.nav.edit', $menu->id) }}" class="btn btn-sm btn-warning" wire:navigate>Edit</a>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-delete-id={{ "$menu->id" }}>
                Delete
            </button>
        </div>
    </td>
</tr>
@isset($menu->children)
    @foreach ($menu->children as $child)
        <x-rbac::menu-item :menu="$child" :$loop />
    @endforeach
@endisset
