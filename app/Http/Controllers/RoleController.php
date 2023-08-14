<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function view_role()
    {
        $permission = Permission::get();
        $role = Role::get();
        return view('admin.role', compact('permission', 'role'));
    }
    public function save_role(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->to('role-access')->with('success', 'Role berhasil disimpan');
    }
    public function update_role($id, Request $request)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);
        return redirect()->to('role-access')->with('success', 'Role berhasil diubah');
    }
    public function getRoleByJson($id)
    {
        $role = Role::where('id', $id)->first();
        $permission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $allpermission
            = Permission::get();
        $data = [
            'role' => $role,
            'permission' => $permission,
            'allpermission' => $allpermission
        ];
        return response()->json($data, 200);
    }
    public function checkNameRole($name){
        $checkId = !empty($_GET['id']);
        if ($checkId) {
            $role = Role::where('name', $name)->where('id','!=',$_GET['id'])->count();
        }else{
            $role = Role::where('name', $name)->count();
        }

        if ($role != 0) {
            $msg = [
                'name' => true
            ];
            return response()->json($msg, 200);
        }else{
            $msg = [
                'name' => false
            ];
            return response()->json($msg, 200);
        }
    }
    public function getCountUser($id)
    {
        $role = Role::findOrFail($id);
        $data = User::role($role->name)->count();
        $data = [
            'role' => $role->name,
            'total_user' => $data
        ];

        return response()->json($data, 200);
    }
    public function delete_role($id)
    {
        $role = Role::findOrFail($id);
        $usersWithRole = User::role($role->name)->get();

        // Hapus peran dari pengguna
        foreach ($usersWithRole as $user) {
            $user = User::findOrFail($user->id)->delete();
        }
        $role->delete();
        return redirect()->to('role-access')->with('success', 'Role berhasil dihapus');
    }
}
