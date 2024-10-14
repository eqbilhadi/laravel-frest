@if ($menu->children->isEmpty())
    <li class="menu-item @if (request()->is($menu->url . '*')) active @endif">
        <a href="{{ $menu->route_name && Route::has($menu->route_name) ? route($menu->route_name) : '/' }}" class="menu-link" wire:navigate>
            @if ($menu->parent_id)
                <i class="{{ $menu->icon }} me-3 fa-fw"></i>
            @else
                <i class="menu-icon tf-icons fa-fw me-3 {{ $menu->icon }}"></i>
            @endif
            <div>{{ $menu->label_name }}</div>
        </a>
    </li>
@else
    @unless ($menu->is_divider)
        <li class="menu-item @if (request()->is($menu->url . '*')) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                @unless ($menu->parent_id)
                    <i class="menu-icon tf-icons fa-fw me-3 {{ $menu->icon }}"></i>
                @endunless
                <div>{{ $menu->label_name }}</div>
            </a>
            <ul class="menu-sub">
                @foreach ($menu->children as $child)
                    <x-layouts.app.menu :menu="$child" />
                @endforeach
            </ul>
        </li>
    @else
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ $menu->label_name }}</span>
        </li>
        @foreach ($menu->children as $child)
            <x-layouts.app.menu :menu="$child" />
        @endforeach
    @endunless
@endif
