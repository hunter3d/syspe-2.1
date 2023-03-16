<?php

namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleAddFormRequest extends FormRequest
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
    public function attributes() {
        return [
            'name' => __('config/roles/add.name'),
            'permissions' => __('config/roles/add.permissions'),
        ];
    }
    public function store() {
        $role = Role::create([
            'name' => $this->input('name'),
            'guard_name' => 'web',
        ]);
        if ( $this->input('permissions') && $this->input('permissions') != '') {
            $p = $this->input('permissions');
            $permissions = explode(',',$p);
            // add new list of permission
            foreach ( $permissions as $permission ) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
