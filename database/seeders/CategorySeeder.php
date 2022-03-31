<?php

namespace Database\Seeders;

use App\Category;
use App\Service;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(4)->create()->each(function ($category)
        {
            // Create 5 services for each category
            $services =  Service::factory()->count(5)->create();
            $category->services()->saveMany($services);
        });
    }
}
