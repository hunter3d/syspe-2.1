<x-app head-title="Добавить пользователя">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-users text-secondary"></i>&nbsp;Добавить пользователя</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Новый сотрудник
                    </div>
                    <form action="/config/staff/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-4 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                                    <div id="emailHelp" class="form-text">Email будет использоваться для входа в систему.</div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="repassword" class="form-label">Подтверждение пароля</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="repassword" required>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="last_name" class="form-label">Фамилия</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" required>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="first_name" class="form-label">Имя</label>
                                    <input name="first_name" type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="is_blocked" class="form-label">Статус</label>
                                    <select name="is_blocked" id="is_blocked" class="form-select" aria-label="Статус">
                                        <option value="0" {{old('is_blocked')=='0'?'selected':''}}>Работает</option>
                                        <option value="1" {{old('is_blocked')=='1'?'selected':''}}>Заблокирован</option>
                                    </select>
                                </div>

                                <div class="col-lg-12    mb-4">
                                    <label for="roles" class="form-label">Доступ (Роль)</label>
                                    <input name="roles" class="form-control" id="roles" aria-describedby="rolesHelp" value="">
                                    <div id="rolesHelp" class="form-text">Роль пользователя в системе. Определяет доступ к элементам системы.</div>
                                </div>
                                <link rel="stylesheet" href="/css/amsify.suggestags.css">
                                <script src="/js/jquery.amsify.suggestags.js"></script>
                                <script>
                                    $('input[name="roles"]').amsifySuggestags({
                                        delimiters:[','],
                                        type :'amsify',
                                        suggestions: [<?php echo '"'.implode('","', preg_replace('/[^a-zA-Z0-9а-яА-Я ]/u','',$all_roles)).'"' ?>],
                                        whiteList: true,
                                    });
                                </script>
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
