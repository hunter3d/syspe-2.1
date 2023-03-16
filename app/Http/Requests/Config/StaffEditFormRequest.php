<?php

namespace App\Http\Requests\Config;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StaffEditFormRequest extends FormRequest
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
            'password'                  => ['confirmed'],
            'password_confirmation'     => [],
            'last_name'                 => ['required','string'],
            'first_name'                => ['required','string'],
            'is_blocked'                => ['required','integer'],
        ];
    }
    public function attributes()
    {
        return [
            'password'                  => 'Пароль',
            'password_confirmation'     => 'Подтверждение пароля',
            'last_name'                 => 'Фамилия',
            'first_name'                => 'Имя',
            'is_blocked'                => 'Статус',
        ];
    }

    public function update( $id ) {
        $staff = User::find($id);

        // пихаем в базу
        if ( $this->has('password') && $this->input('password')!='')
            $staff->password        = Hash::make($this->input('password'));
        $staff->is_blocked          = $this->input('is_blocked');
        $staff->first_name          = $this->input('first_name');
        $staff->last_name           = $this->input('last_name');
        $staff->save();

        // Изменяем роли
        $old_roles = $staff->roles->pluck('name');
        foreach ($old_roles as $old) {
            $staff->removeRole( $old );
        }
        if ( $this->input('roles') && $this->input('roles') != '') {
            $r = $this->input('roles');
            $roles = explode(',',$r);
            // add list of roles for user
            foreach ( $roles as $role ) {
                $staff->assignRole($role);
            }
        }
    }
}
