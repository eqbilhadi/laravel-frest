<?php

namespace Modules\Rbac\Builders;

use Illuminate\Database\Eloquent\Builder;
use Modules\Rbac\App\Models\ComMenu;

class ComMenuBuilder extends Builder
{
    public function sortMenu($navId, $direction)
    {
        // Ambil data menu saat ini berdasarkan ID
        $currentMenu = $this->find($navId);

        // Tentukan urutan naik/turun berdasarkan arah
        $isMovingUp = $direction === 'up';
        $operator = $isMovingUp ? '<' : '>';
        $sortOrder = $isMovingUp ? 'desc' : 'asc';

        // Ambil menu yang posisinya di atas atau di bawah (tergantung arah)
        $adjacentMenu = ComMenu::query()
            ->orderBy('sort_num', $sortOrder)
            ->where('sort_num', $operator, $currentMenu->sort_num)
            ->when($currentMenu->parent_id, function ($query) use ($currentMenu) {
                // Jika ada `parent_id`, ambil yang ada di parent yang sama
                $query->where('parent_id', $currentMenu->parent_id);
            })
            ->when(!$currentMenu->parent_id, function ($query) {
                // Jika tidak ada `parent_id`, ambil menu tanpa parent
                $query->whereNull('parent_id');
            })
            ->first();

        // Jika ada menu yang bisa ditukar urutannya
        if ($adjacentMenu) {
            // Simpan nilai sort_num dari adjacentMenu sebelum memperbarui
            $adjacentSortNum = $adjacentMenu->sort_num;

            // Tukar urutan (sort_num) antara menu saat ini dan menu di atas/bawah
            $adjacentMenu->update(['sort_num' => $currentMenu->sort_num]);
            $currentMenu->update(['sort_num' => $adjacentSortNum]);
        }
    }

    public function updateStatus($id)
    {
        $menu = $this->find($id);
        $menu->update(["is_active" => !$menu->is_active]);
    }
}
