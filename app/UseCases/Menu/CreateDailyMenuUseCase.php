<?php

namespace App\UseCases\Menu;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class CreateDailyMenuUseCase
{
    public function execute(Restaurant $restaurant, array $data): Menu
    {
        return DB::transaction(function () use ($restaurant, $data) {
            $menu = Menu::create([
                'restaurant_id' => $restaurant->id,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
                'date' => $data['date'],
                'status' => 'draft',
            ]);

            foreach ($data['sections'] as $index => $sectionData) {
                $section = $menu->sections()->create([
                    'name' => $sectionData['name'],
                    'order' => $sectionData['order'] ?? $index,
                ]);

                foreach ($sectionData['dishes'] as $dishData) {
                    $section->dishes()->create([
                        'name' => $dishData['name'],
                        'description' => $dishData['description'] ?? null,
                    ]);
                }
            }

            return $menu;
        });
    }
}
