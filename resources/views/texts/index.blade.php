<x-app head-title="Тексты">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-file-alt text-secondary"></i>&nbsp;Мероприятия</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/texts/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список текстов | статисческие тексты
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">#</th>
                                <th class="text-nowrap" scope="col">Описание</th>
                                <th class="text-nowrap" scope="col">Текст RU</th>
                                <th class="text-nowrap" scope="col">Текст UK</th>
                                <th class="text-nowrap" scope="col">Текст EN</th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($texts as $text)
                                <tr>
                                    <td>{{ $text->id }}</td>
                                    <td>{{ $text->name }}</td>
                                    <td>{{ Str::limit(htmlspecialchars_decode($text->text_ru),250) }}</td>
                                    <td>{{ Str::limit(htmlspecialchars_decode($text->text_uk),250) }}</td>
                                    <td>{{ Str::limit(htmlspecialchars_decode($text->text_en),250) }}</td>
                                    <td><a href="/texts/edit/{{$text->id}}"><i class="fal fa-fw fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
