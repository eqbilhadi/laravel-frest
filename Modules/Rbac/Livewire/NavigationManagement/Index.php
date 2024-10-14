<?php

namespace Modules\Rbac\Livewire\NavigationManagement;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Rbac\App\Jobs\ForgetCacheMenu;
use Modules\Rbac\App\Models\ComMenu;

class Index extends Component
{
    #[Computed]
    public function navLists()
    {
        return ComMenu::query()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_num')
            ->get();
    }

    public function changeOrder($navId, $direction)
    {
        ComMenu::sortMenu($navId, $direction);
        dispatch(new ForgetCacheMenu());
    }
    
    public function changeStatus($navId)
    {
        ComMenu::updateStatus($navId);
        dispatch(new ForgetCacheMenu());
    }

    public function render()
    {
        return view('rbac::livewire.navigation-management.index', [
            "navs" => $this->navLists
        ]);
    }
}
