<?php

namespace Modules\Rbac\Services\Registration\Navigation;

use Illuminate\Support\Arr;
use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\Services\Registration\RegistrationService;

class NavigationRegistration extends RegistrationService
{

    protected array $data = [];

    protected ?ComMenu $comMenu = null;

    /**
     * Method __construct
     *
     * @param ?ComMenu $comMenu [explicite description]
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function __construct(array $data = [], ?ComMenu $comMenu = null)
    {
        $this->data = $data;

        $this->comMenu = $comMenu;
    }

    /**
     * Method save
     *
     * @return void
     */
    public function save(): void
    {
        if (!$this->comMenu->exists) {
            $this->create();
        } else {
            $this->update();
        }
    }

    /**
     * Method create
     *
     * @return static
     */
    protected function create(): static
    {
        $this->comMenu = ComMenu::create($this->getRegistrationDataComMenu());

        return $this;
    }

    /**
     * Method update
     *
     * @return static
     */
    protected function update(): static
    {
        $this->comMenu->update($this->getRegistrationDataComMenu());

        return $this;
    }

    /**
     * Method getRegistrationDataComMenu
     *
     * @return array
     */
    protected function getRegistrationDataComMenu(): array
    {
        // set data
        $data = [
            'parent_id' => Arr::get($this->data, 'parent_id'),
            'sort_num' => $this->getSortNumNav(),
            'icon' => Arr::get($this->data, 'icon'),
            'label_name' => Arr::get($this->data, 'label_name'),
            'controller_name' => Arr::get($this->data, 'controller_name'),
            'route_name' => Arr::get($this->data, 'route_name'),
            'url' => Arr::get($this->data, 'url'),
            'is_active' => Arr::get($this->data, 'is_active'),
            'is_divider' => Arr::get($this->data, 'is_divider'),
        ];

        $data = array_map(function ($value) {
            return $value === "" ? null : $value;
        }, $data);
        
        return $data;
    }

    protected function getSortNumNav()
    {
        $parentNav = $this->data['parent_id'];

        /** Jika menambah data baru dan main nav */
        if (!$this->comMenu->exists && $parentNav == "") {
            $sortNum = ComMenu::whereNull('parent_id')->max('sort_num');
        }

        /** Jika menambah data baru dan bukan main nav */
        if (!$this->comMenu->exists && $parentNav != "") {
            $sortNum = ComMenu::whereParentId($parentNav)->max('sort_num');
        }

        /** Jika mengubah data yang ada dan bukan main nav */
        if ($this->comMenu->exists && $parentNav != "") {
            $this->comMenu->parent_id = $parentNav;
            if ($this->comMenu->isDirty('parent_id')) {
                $sortNum = ComMenu::whereParentId($parentNav)->max('sort_num');
            } else {
                return $this->comMenu->sort_num;
            }
        }

        /** Jika mengubah data yang ada dan main nav */
        if ($this->comMenu->exists && $parentNav == "") {
            $this->comMenu->parent_id = $parentNav;
            if ($this->comMenu->isDirty('parent_id')) {
                $sortNum = ComMenu::whereNull('parent_id')->max('sort_num');
            } else {
                return $this->comMenu->sort_num;
            }
        }

        return $sortNum + 1;
    }
}
