<?php
# (c) PremierExpo 2022
namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffAddFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'                     => ['bail','required','string','email','unique:App\Models\User,email'],
            'password'                  => ['required','string','confirmed'],
            'password_confirmation'     => ['required','string'],
            'last_name'                 => ['required','string'],
            'first_name'                => ['required','string'],
            'is_blocked'                => ['required','integer'],
            'roles'                     => ['nullable','string'],
        ];
    }
    public function attributes()
    {
        return [
            'email'                     => 'Email',
            'password'                  => 'Пароль',
            'password_confirmation'     => 'Подтверждение пароля',
            'last_name'                 => 'Фамилия',
            'first_name'                => 'Имя',
            'is_blocked'                => 'Статус',
            'roles'                     => 'Доступ (Роль)',
        ];
    }

    public function store()
    {
        // пихаем в базу
        $user = User::create([
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
            'is_blocked' => $this->input('is_blocked'),
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
        ]);

        // Добавляем роли
        if ( $this->input('roles') && $this->input('roles') != '')
        {
            $r = $this->input('roles');
            $roles = explode(',',$r);
            // add list of roles for user
            foreach ( $roles as $role ) {
                $user->assignRole($role);
            }
        }
        activity('user')->withProperties(['ip' => request()->ip()])->log('Добавлен новый пользователь: '.getFioById($user->id));
    }

    public function authorize(): bool
    {
        return Auth::check();
    }
}
