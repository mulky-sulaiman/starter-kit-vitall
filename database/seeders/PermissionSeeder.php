<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // God Mode
            '*',
            '*.*',
            '*.*.*',
            // Permissions
            'permissions.*',
            'permissions.create',
            'permissions.view.any',
            'permissions.view',
            'permissions.update.any',
            'permissions.update',
            'permissions.delete.any',
            'permissions.delete',
            // Roles
            'roles.*',
            'roles.create',
            'roles.view.any',
            'roles.view',
            'roles.update.any',
            'roles.update',
            'roles.delete.any',
            'roles.delete',
            // Users
            'users.*',
            'users.create',
            'users.view.any',
            'users.view',
            'users.update.any',
            'users.update',
            'users.delete.any',
            'users.delete',
        ];

        foreach ($permissions as $permission) {
            $label = ucwords(Str::replace('.', ' ', $permission));
            $arr = explode(' ', $label);
            $group = $arr[0];
            Permission::create(['name' => $permission, 'label' => $label, 'group' => $group]);
        }

        $superadmin = Role::create(['name' => RoleEnum::SUPER_ADMIN->value, 'code' => RoleEnum::SUPER_ADMIN->value, 'label' => RoleEnum::SUPER_ADMIN->label()]);

        $superadmin->syncPermissions($permissions);

        $admin = Role::create(['name' => RoleEnum::ADMIN->value, 'code' => RoleEnum::ADMIN->value, 'label' => RoleEnum::ADMIN->label()]);

        $admin->syncPermissions([
            // Users
            'users.*',
            'users.create',
            'users.view.any',
            'users.view',
            'users.update.any',
            'users.update',
            'users.delete.any',
            'users.delete',
        ]);

        $operator = Role::create(['name' => RoleEnum::OPERATOR->value, 'code' => RoleEnum::OPERATOR->value, 'label' => RoleEnum::OPERATOR->label()]);

        $operator->syncPermissions([
            // Users
            // 'users.*',
            // 'users.create',
            'users.view.any',
            'users.view',
            'users.update.any',
            'users.update',
            'users.delete.any',
            'users.delete',
        ]);

        $operator = Role::create(['name' => RoleEnum::MEMBER->value, 'code' => RoleEnum::MEMBER->value, 'label' => RoleEnum::MEMBER->label()]);

        $operator->syncPermissions([
            // Users
            // 'users.*',
            // 'users.create',
            'users.view.any',
            'users.view',
            // 'users.update.any',
            'users.update',
            // 'users.delete.any',
            'users.delete',
        ]);
    }
}
