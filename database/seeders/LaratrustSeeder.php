<?php
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laratrust\Models\Permission as ModelsPermission;
use Laratrust\Models\Role as ModelsRole;

class LaratrustSeeder extends Seeder
{
    public function run(): void
    {
        $role = ModelsRole::create(['name' => 'super_admin', 'display_name' => 'Super Admin']);

        $admin = Admin::create([
            'name' => 'Main Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
        ]);

        $admin->attachRole($role);

        ModelsPermission::create(['name' => 'manage_users', 'display_name' => 'Manage Users']);
        ModelsPermission::create(['name' => 'manage_roles', 'display_name' => 'Manage Roles']);
    }
}
