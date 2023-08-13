<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function view_user()
    {
        $roles = Role::get();
        $users = User::get();
        return view('admin.user',compact('roles','users'));
    }
    public function getUserDetailJson($id){
        $users = User::findOrFail($id);
        $roles = $users->roles;

        $data = [
            'users' => $users
        ];
        return response()->json($data, 200);
    }
    public function create_user(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        $messages = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'role.required' => 'Role harus dipilih.'
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ], $messages);

        $saved = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        if ($saved) {
            $saved->assignRole($role);
            return redirect()->to('user-access')->with('success', 'User berhasil disimpan');
        } else {
            return redirect()->to('user-access')->with('success', 'User gagal disimpan');
        }
    }
    public function update_user($id,Request $request)
    {
        $user = User::find($id);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $saved = $user->update([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        if ($saved) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($role);
            return redirect()->to('user-access')->with('success', 'User berhasil diubah');;
        } else {
            return redirect()->to('user-access')->with('success', 'User gagal diubah');
        }
    }
    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->to('user-access')->with('success', 'User berhasil dihapus');
    }
}
