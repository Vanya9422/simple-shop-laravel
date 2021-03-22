<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->progressStart(10);
        Category::factory()->count(10)->create()->each(function ($cat) {
            $this->command->getOutput()->progressAdvance();
        });
        $this->command->getOutput()->progressFinish();
    }
}
