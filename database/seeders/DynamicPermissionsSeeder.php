<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DynamicPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissionsConfig = Config::get('permissions', []);

        if (empty($permissionsConfig)) {
            $this->command->warn('⚠️ No permissions found in config/permissions.php');
            return;
        }

        $this->command->info('🔄 Starting permissions seeding...');

        DB::beginTransaction();

        try {
            foreach ($permissionsConfig as $module => $actions) {
                foreach ($actions as $action) {
                    $name = "{$module}.{$action}";
                    Permission::updateOrCreate(
                        ['name' => $name],
                        [
                            'display_name' => ucfirst($action) . ' ' . ucfirst($module),
                            'description' => "Allow user to {$action} {$module}",
                        ]
                    );
                }
            }

            $this->command->info('✅ Permissions seeded successfully.');

            // Attach all permissions to Super Admin (optional)
            $role = Role::where('name', 'super-admin')->first();

            if ($role) {
                $allPermissions = Permission::all()->pluck('id')->toArray();
                $role->permissions()->sync($allPermissions);
                $this->command->info('👑 All permissions attached to Super Admin.');
            } else {
                $this->command->warn('⚠️ No role named "super-admin" found. Skipped role sync.');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error: ' . $e->getMessage());
        }
    }
}
