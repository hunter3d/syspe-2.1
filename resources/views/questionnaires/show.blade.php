<x-app head-title="Опросники > карточка вопроса и варианты ответа">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-check-square text-secondary"></i>&nbsp;Опросники <small>карточка вопроса и варианты ответов</small></h1>
                <p>
                    <strong>Вопрос:</strong> {{$quest->question_ru}}<br>
                    <strong>Тип: </strong> {{$quest->type}}
                </p>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="/questionnaires/index" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/answeroptions/add/{{$quest->id}}" class="btn btn-primary" title="Добавить вариант ответа">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Варианты ответов
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm align-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('answer_uk','Вариант ответа UA')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('answer_ru','Вариант ответа RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('answer_en','Вариант ответа EN')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('order','Порядок')</th>
                                <th class="text-nowrap"></th>
                                <th class="text-nowrap"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($answers as $answer)
                                <tr>
                                    <th scope="row">{{ $answer->id }}</th>
                                    <td>{{ $answer->answer_uk }}</td>
                                    <td>{{ $answer->answer_ru }}</td>
                                    <td>{{ $answer->answer_en }}</td>
                                    <td>{{ $answer->order }}</td>
                                    <td><a href="/answeroptions/edit/{{$answer->id}}" title="Редактировать вариант ответа"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/answeroptions/delete/{{$answer->id}}" title="Удалить вариант ответа." onclick="return confirm('Вы уверены, что хотите удалить вариант овета?')"><i class="fal fa-fw fa-trash"></i></a></td>
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
