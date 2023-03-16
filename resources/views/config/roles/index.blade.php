<x-app head-title="Роли">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-shield-check text-secondary"></i> Роли
                </h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/config/roles/add" class="btn btn-primary" title="add">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список ролей
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Роли</th>
                                <th scope="col">Разрешения</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @php
                                            $permissions = \Spatie\Permission\Models\Role::findByName($role->name)->permissions;
                                            $string = '';
                                            foreach ($permissions as $permission) {
                                                $string = $string.' <span class="badge bg-primary">'.$permission->name.'</span>';
                                            }
                                            echo $string;
                                        @endphp
                                    </td>
                                    <td><a href="/config/roles/edit/{{ $role->id }}"><i class="fal fa-edit fa-fw" title="Редактировать роль"></i></a></td>
                                    <td><a href="/config/roles/delete/{{ $role->id }}" onclick="return confirm('Вы уверены что собираетесь удалить роль: &laquo;{{ $role->name }}&raquo;?')"><i class="fal fa-trash fa-fw" title="Удалить роль"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
{{--                    <div class="card-footer d-flex justify-content-center align-items-center">--}}

{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</x-app>
