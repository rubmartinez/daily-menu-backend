<?php

namespace App\UseCases\Menu;

use App\Models\Menu;

class PublishDailyMenuUseCase
{
    public function execute(Menu $menu): Menu
    {
        // Archive any other published menu for the same restaurant and date
        Menu::where('restaurant_id', $menu->restaurant_id)
            ->where('date', $menu->date)
            ->where('id', '!=', $menu->id)
            ->where('status', 'published')
            ->update(['status' => 'archived']);

        $menu->update(['status' => 'published']);

        return $menu->fresh();
    }
}
