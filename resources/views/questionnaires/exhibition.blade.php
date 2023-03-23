<x-app head-title="Опросники | {{$exhb->name}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-check-square text-secondary"></i>&nbsp;Опросники | <small>{{ $exhb->name }}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEx" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставка
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEx">
                    <li><a class="dropdown-item" href="{{ route('questionnaires') }}">Все</a></li>
                    @foreach($exhibitions as $exhibition)
                        <li><a class="dropdown-item" href="{{ route('questionnaires.exhibition',['id'=>$exhibition->id]) }}">{{$exhibition->name}}</a></li>
                    @endforeach
                </ul>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Статус
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('questionnaires') }}">Все</a></li>
                    <li><a class="dropdown-item" href="{{ route('questionnaires',['template'=>0]) }}">Активные</a></li>
                    <li><a class="dropdown-item" href="{{ route('questionnaires',['template'=>1]) }}">Черновики</a></li>
                </ul>
                <a href="/questionnaires/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Опросники | {{ $exhb->name }}
                        @if( isset($filter_status) )
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> {{$filter_status}}</span>
                        @else
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> Все</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('exhibition_id','Выставка')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('type','Тип')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('question_uk','Вопрос UA')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('question_ru','Вопрос RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('question_en','Вопрос EN')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('template','Статус')</th>
                                <th class="text-nowrap"><i class="fal fa-fw fa-list"></i></th>
                                <th class="text-nowrap"></th>
                                <th class="text-nowrap"></th>
                                <th class="text-nowrap"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quests as $quest)
                                <tr class="{{ $quest->template==1?'table-secondary text-muted':'' }}">
                                    <th scope="row">{{ $quest->id }}</th>
                                    <td>{{ $quest->exhibition->name }}</td>
                                    <td>{{ $quest->type }}</td>
                                    <td>{{ $quest->question_uk }}</td>
                                    <td>{{ $quest->question_ru }}</td>
                                    <td>{{ $quest->question_en }}</td>
                                    <td class="{{$quest->template==0?'table-success':''}}">{{ $quest->template==0?'Активная':'Черновик' }}</td>
                                    <td>{{ \App\Models\Answeroptions::query()->where('questionnaire_id', $quest->id)->count() }}</td>
                                    <td><a href="/questionnaires/show/{{$quest->id}}" title="Посмотреть карточку вопроса и варианты ответов"><i class="fal fa-fw fa-eye"></i></a></td>
                                    <td><a href="/questionnaires/edit/{{$quest->id}}" title="Редактировать вопрос"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/questionnaires/delete/{{$quest->id}}" title="Удалить вопрос и все варианты ответов." onclick="return confirm('Вы уверены, что хотите удалить вопрос и все варианты оветов?')"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $quests->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
