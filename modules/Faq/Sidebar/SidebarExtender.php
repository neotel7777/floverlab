<?php

namespace Modules\Faq\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('admin::sidebar.faq'), function (Item $item) {
                $item->item(trans('faq::faq.items.name'), function (Item $item) {
                    $item->weight(12);
                    $item->route('admin.faq.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.faq.index')
                    );
                });
            });
        });
    }
}
