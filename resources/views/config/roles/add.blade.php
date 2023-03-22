<x-app head-title="Добавить роль">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-shield-check text-secondary"></i> Добавить роль
                </h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Новая роль
                    </div>
                    <form action="/config/roles/add" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Название</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ old('name') }}" required>
                                <div id="nameHelp" class="form-text">Названиие роли</div>
                            </div>
                            <div class="mb-4">
                                <label for="permissions" class="form-label">Разрешения</label>
                                <input name="permissions" class="form-control" id="permissions" rows="3" aria-describedby="permissionsHelp" value="">
                                <div id="descriptionHelp" class="form-text">Список разрешений</div>
                            </div>
                            <link rel="stylesheet" href="{{asset('css/amsify.suggestags.css')}}">
                            <script src="{{asset('js/jquery.amsify.suggestags.js')}}"></script>
                            <script>
                                $('input[name="permissions"]').amsifySuggestags({
                                    delimiters:[','],
                                    type :'amsify',
                                    suggestions: [<?php echo '"'.implode('","', preg_replace('/[^a-zA-Z0-9а-яА-Я ]/u','',$all_permissions)).'"' ?>],
                                    whiteList: true,
                                });
                            </script>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
{{--                    <div class="card-footer d-flex justify-content-center align-items-center">--}}

{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</x-app>
