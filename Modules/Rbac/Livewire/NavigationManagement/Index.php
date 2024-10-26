<?php

namespace Modules\Rbac\Livewire\NavigationManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Rbac\App\Jobs\ForgetCacheMenu;
use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\Services\Registration\Navigation\NavigationDestroy;

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

    public function delete($id)
    {
        try {
            (new NavigationDestroy($id))->handle();
            dispatch(new ForgetCacheMenu());

            $this->dispatch('close-modal-delete');
            toastr()->closeButton(true)->addSuccess('Deleted navigation successfully');
        } catch (\Throwable $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.navigation-management.index', [
            "navs" => $this->navLists
        ]);
    }
}
