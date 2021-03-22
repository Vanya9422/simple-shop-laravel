<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * @var array $allPermissions
     */
    protected $allPermissions = [
        "admin" => [
            'allow all actions',
        ],
        "seller" => [
            'add product',
            'edit own product',
            'confirm own product orders',
            'show own products',
            'show own product orders',
            'delete own product'
        ],
        "customer" => [
            'add order',
            'show own orders'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::all()->map(function ($role) {
            collect($this->allPermissions[$role->name])->map(function ($permission) use ($role) {
                Permission::firstOrCreate(['name' => $permission]);
                $role->givePermissionTo($permission);
            });
        });
    }
}
