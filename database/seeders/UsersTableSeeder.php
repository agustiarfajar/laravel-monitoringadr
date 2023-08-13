<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        $user2 = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user')
        ]);
        $auth = ['user', 'role'];
        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $permissions = Permission::pluck('id', 'id')->all();
        $getPermissions = Permission::whereNotIn('name', $auth)->get();
        $role2->syncPermissions($getPermissions);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        $user2->assignRole([$role2->id]);
    }
}
