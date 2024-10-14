<?php

namespace App\View\Components\Layouts\App;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;
use Modules\Rbac\App\Models\ComMenu;

class Aside extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menus = $this->getCachingMenus();
        
        return view('components.layouts.app.aside', compact('menus'));
    }

    /**
     * Method getCachingMenus
     *
     * @return void
     */
    protected function getCachingMenus()
    {
        $user = auth()->user();

        return Cache::remember($user->main_role . '_menus', now()->addhours(5), function () use ($user) {
            return ComMenu::query()
                ->whereHas('roles', fn ($query) => $query->whereIn('role_id', $user->roles->pluck('id')))
                ->where([
                    'parent_id' => null,
                    'is_active' => '1',
                ])
                ->with([
                    'children' => function ($query) use ($user) {
                        $query->whereHas('roles', fn ($query) => $query->whereIn('role_id', $user->roles->pluck('id')))
                            ->where(['is_active' => '1'])
                            ->with('parent');
                    }
                ])
                ->orderBy('sort_num', 'asc')
                ->get();
        });
    }
}
