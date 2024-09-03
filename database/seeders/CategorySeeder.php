<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categories = [
            "Hand tools" => [
                "description" => "Hand tools are manually operated tools that do not require electricity or other power sources.",
                "children" => [
                    "Wrenches and Spanners" => [],
                    "Screwdrivers" => [],
                    "Pliers and Cutters" => [],
                    "Hammers and Mallets" => [],
                ]
            ],
            "Measuring and layout" => [
                "description" => "Measuring and layout tools are used to accurately measure and mark materials for cutting, drilling, or assembly.",
                "children" => [
                    "Tape Measures" => [],
                    "Levels" => [],
                    "Squares" => [],
                    "Calipers" => []
                ],
            ],
            "Power tools" => [
                "description" => "Power tools are operated by electricity, batteries, or compressed air and are capable of performing tasks more efficiently than hand tools.",
                "children" => [
                    "Drills and Drivers" => [],
                    "Saws" => [],
                    "Sanders" => [],
                    "Grinders" => []
                ],
            ],
            "Safety equipment" => [
                "description" => "Safety equipment is designed to protect workers from hazards and prevent accidents in the workplace.",
                "children" => [
                    "Personal Protective Equipment (PPE)" => [],
                    "Respiratory Protection" => [],
                    "Hearing Protection" => [],
                    "Fall Protection" => [],
                ],
            ],
            "Garden and outdoor tools" => [
                "description" => "Garden and outdoor tools are used for landscaping, gardening, and outdoor maintenance tasks.",
                "children" => [
                    "Lawn and Garden Hand Tools" => [],
                    "Lawn Care Equipment" => [],
                    "Landscaping Tools" => [],
                    "Irrigation and Watering" => [],
                ],
            ],
        ];

        foreach ($categories as $name => $content) {
            $this->runFactory($name, $content, null);
        }

        foreach(range(1,20) as $round){
            $id = Category::inRandomOrder()->first()->id;
            Category::factory()->create([
                'name' => 'Random category '.fake()->numberBetween(100, 999),
                'parent_id' => $id
            ]);
        }
    }

    public function runFactory(string $name, array $category = [], int | null $parent)
    {
        $added = Category::factory()->create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $category['description'] ?? '',
            'parent_id' => $parent
        ]);

        if (isset($category["children"])) {
            foreach ($category["children"] as $child_name => $child_content) {
                $this->runFactory($child_name, $child_content, $added->id);
            }
        }
    }
}
