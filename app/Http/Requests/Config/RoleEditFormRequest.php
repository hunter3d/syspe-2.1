<?php

namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string'],
            'permissions' => ['nullable','string'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => __('config/roles/edit.name'),
            'permissions' => __('config/roles/edit.permissions'),
        ];
    }
    public function update($id)
    {
        $role = Role::find($id);
        $role->name = $this->input('name');
        $role->save();

        $old_permissions = $role->permissions->pluck('name');
        // clear old permissions from this Role
        foreach ( $old_permissions as $old )
        {
            $role->revokePermissionTo($old);
        }
        if ( $this->input('permissions') && $this->input('permissions') != '' )
        {
            $p = $this->input('permissions');
            $permissions = explode(',',$p);
            // add new list of permission
            foreach ( $permissions as $permission )
            {
                $role->givePermissionTo($permission);
            }
        }
    }
}
