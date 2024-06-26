<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Producer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Producer::factory(5)->create();
        Category::factory(10)->create();
    }
}
