<?php

namespace App\Http\ViewComposers;


use App\Repositories\Repository\Configuration\MenuRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * @var Collection
     */
    protected $parents;

    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * Create a new permissions composer.
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->parents = $this->menuRepository->findParents();
    }

    private function _fillMenu($menu)
    {

        $result = [];
        $children = $this->menuRepository->findChildren($menu->id);

        if (count($children) == 0) {

            if (null != $menu->slug && currentUser()->can($menu->slug) && $this->checkRole($menu)) {
                $result[$menu->id] = [
                    'label' => $menu->label,
                    'slug' => $menu->slug
                ];

                if (null != $menu->icon) {
                    $result[$menu->id]['icon'] = $menu->icon;
                }
            }

        } else {

            $resultChildren = [];
            foreach ($children as $child) {
                $resultChildren += $this->_fillMenu($child);
            }

            if (count($resultChildren) > 0) {
                $result[$menu->id] = [
                    'label' => $menu->label,
                    'children' => $resultChildren
                ];

                if (null != $menu->icon) {
                    $result[$menu->id]['icon'] = $menu->icon;
                }
            }
        }

        return $result;
    }

    /**
     * @param $menu
     * @return bool
     */
    function checkRole($menu)
    {

        if (isset($menu->role)) {
            $roles = explode("|", $menu->role);

            foreach ($roles as $index => $role) {
                switch ($role) {
                    case 'default':
                        return true;
                        break;
                }
            }
            return false;

        } else
            return true;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $result = [];
        foreach ($this->parents as $parent) {
            $result += $this->_fillMenu($parent);
        }

        $view->with('menus', $result);
    }
}