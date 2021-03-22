<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * @var int
     */
    protected $userCount = 30;

    /**
     * @var int
     */
    protected $productCount = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::getRoleNames(true);
        $admin = null;
        User::factory()->count($this->userCount)->create()->each(function ($user, $key) use ($roles, &$admin) {
            $roleName = !$key ? 'admin' : $roles[rand(1, 2)]->name;
            $user->assignRole($roleName);
            if ($roleName === 'seller') {
                $this->command->getOutput()->progressStart($this->productCount);
                $user->products()->saveMany(Product::factory()->count($this->productCount)->make()->each(function () {
                    $this->command->getOutput()->progressAdvance();
                }));
                $this->command->getOutput()->progressFinish();
            }

            if ($roleName === 'admin'){
               $admin = $user;
            }
        });

        if ($admin){
            $this->command->info("====================================================== Admin user ====================================================== \n");
            $this->command->info(print_r($admin->getInfoUserForSeeder(), true) . "\n");
            $this->command->info("======================================================  Admin user ======================================================");
        } else {
            $this->command->warn("Admin user not fount");
        }
    }
}
