<x-app head-title="Анкеты посетителей">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-question-square text-secondary"></i> Анкеты посетителей
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
                        Мероприятия | Всего: <strong>{{count($events)}}</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_ru','Мероприятие')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('start','Начало')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('stop','Конец')</th>
                                <th>Анкет:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td>{{$event->name_ru}}</td>
                                    <td>{{$event->start}}</td>
                                    <td>{{$event->stop}}</td>
                                    <td>{{ ($event->answer?count($event->answer):'0') }}</td>
                                    <td><a href="/answers/show/{{$event->id}}">Посмотреть анкеты</a></td>
                                    <td><a href="/answers/showcard/{{$event->id}}">Посмотреть анкеты + карточки</a></td>
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
