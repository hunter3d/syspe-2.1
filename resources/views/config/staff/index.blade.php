<x-app head-title="Сотрудники">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-users text-secondary"></i>&nbsp;Сотрудники</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/config/staff/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список сотрудников
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('email','Email')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('last_name','Фамилия')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('first_name','Имя')</th>
                                <th>Роли</th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>
                                        @php
                                            $roles = $user->roles;
                                            $string = '';
                                            foreach ($roles as $role) {
                                                $string .='<a href="/config/roles/edit/'.$role->id.'"><span class="badge bg-primary">'.$role->name.'</span></a>';
                                            }
                                            echo $string;
                                        @endphp
                                    </td>
                                    <td><a href="/config/staff/edit/{{ $user->id }}"><i class="fal fa-edit fa-fw" title="Редактировать карточку"></i></a></td>
                                    @if( $user->is_blocked == 0 )
                                        <td><a href="/config/staff/block/{{ $user->id }}" title="Заблокировать"><i class="fal fa-lock-open text-success"></i></a></td>
                                    @else
                                        <td><a href="/config/staff/block/{{ $user->id }}" title="Разблокировать"><i class="fal fa-lock text-danger"></i></a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $users->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
