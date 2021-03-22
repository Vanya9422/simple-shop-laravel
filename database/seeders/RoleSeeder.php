<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * @var array $roles
     */
    protected $roles = [
        'admin' => 'Admin',
        'seller' => 'Seller',
        'customer' => 'Customer',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->roles)->each(function ($item, $key) {
            $role = Role::firstOrNew(['name' => $key]);
            if (!$role->exists) {
                $role->fill([
                    'display_name' => __($item),
                    'guard_name' => 'web',
                ])->save();
            }
        });
    }
}
