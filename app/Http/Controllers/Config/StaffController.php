<?php
# (c) PremierExpo 2022
namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\StaffAddFormRequest;
use App\Http\Requests\Config\StaffEditFormRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;


class StaffController extends Controller
{
    public function index()
    {
        $data['users'] = User::sortable()->paginate(50);
        return view('config.staff.index', $data);
    }

    public function create()
    {
//        $data['users'] = User::where('is_blocked',0)->get();
        $all_roles = Role::orderBy('name','ASC')->get();
        $data['all_roles'] = array();
        foreach ( $all_roles as $all_role ) {
            array_push( $data['all_roles'], $all_role->name );
        }
        return view('config.staff.add',$data);
    }

    public function store( StaffAddFormRequest $request )
    {
        $request->store();
        return redirect()->route('staff');
    }

    public function edit( $id )
    {
//        $data['users'] = User::where('is_blocked',0)->get();
//        $data['departments'] = Department::all();
//        $data['positions'] = Position::all();
        $data['person'] = User::find($id);
        $data['roles'] = '';
        foreach ( $data['person']->roles as $role )
        {
            $data['roles'] .= $role->name.',';
        }
        $all_roles = Role::orderBy('name','ASC')->get();
        $data['all_roles'] = array();
        foreach ( $all_roles as $all_role ) {
            array_push( $data['all_roles'], $all_role->name );
        }
        return view('config.staff.edit', $data);
    }

    public function update( $id, StaffEditFormRequest $request )
    {
        $request->update( $id );
        return redirect()->route('staff');
    }

    public function block( $id )
    {
        $user = User::find($id);
        if ($user->is_blocked == 0) {
            $user->is_blocked = 1;
        } else {
            $user->is_blocked = 0;
        }
        $user->save();
        return back();
    }
}
