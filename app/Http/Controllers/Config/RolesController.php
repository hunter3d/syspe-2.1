<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\RoleAddFormRequest;
use App\Http\Requests\Config\RoleEditFormRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::all();
        return view('config.roles.index',$data);
    }

    public function create()
    {
        $all_permissions = Permission::orderBy('name','ASC')->get();
        $data['all_permissions'] = array();
        foreach ($all_permissions as $all_permission)
        {
            array_push( $data['all_permissions'], $all_permission->name);
        }
        return view('config.roles.add',$data);
    }

    public function store( RoleAddFormRequest $request)
    {
        $request->store();
        return redirect()->route('roles');
    }

    public function edit( $id )
    {
        $data['role'] = Role::find($id);
        $data['permissions'] = '';
        foreach ($data['role']->permissions as $permission)
        {
            $data['permissions'] .= $permission->name.',';
        }
        $data['all_permissions'] = array();
        $all_permissions = Permission::orderBy('Name','ASC')->get();
        foreach ($all_permissions as $all_permission)
        {
            array_push( $data['all_permissions'], $all_permission->name);
        }
        $data['users'] = User::role($data['role']->name)->get();
        return view('config.roles.edit',$data);
    }
    public function update($id, RoleEditFormRequest $request)
    {
        $request->update( $id );
        return redirect()->route('roles');
    }
    public function destroy( $id )
    {
        $role = Role::find( $id );
        $users = User::role($role->name)->count();
        if ($users > 0)
        {
            return back()->withErrors('Роль привязана, как минимум к одному пользователю. Вы не можете ее удалить.');
        } else {
            $old_permissions = $role->permissions->pluck('name');
            // clear old permissions from this Role
            foreach ( $old_permissions as $old ) {
                $role->revokePermissionTo($old);
            }
            $role->delete();
            return redirect()->route('roles');
        }
    }
}
