<x-app head-title="Мероприятия | {{$exhibition->name}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-calendar-check text-secondary"></i>&nbsp;Мероприятия | <small class="text-muted">{{$exhibition->name}}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('exhibitions') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/events/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список мероприятий  | {{$exhibition->name}} | Всего: <strong>{{$total}}</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_ua','Название UA')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('description_ua','Описание UA')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('start','Начало')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('start','Конец')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('exhibition.name','Выставка')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price','Стоимость')</th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-brackets"></i></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class="{{ $event->template==1?'table-secondary text-muted':'' }}">
                                    <th scope="row">{{ $event->id }}</th>
                                    <td>{{ $event->name_ua }}</td>
                                    <td>{{ $event->description_ua }}</td>
                                    <td>{{ $event->start }}</td>
                                    <td>{{ $event->stop }}</td>
                                    <td>{{ $event->exhibition->name }}</td>
                                    <td>{{ $event->price }}</td>
                                    @if ($event->template == 0)
                                        <td class="text-success"><i class="fal fa-fw fa-unlock"></i></td>
                                    @else
                                        <td class="text-danger"><i class="fal fa-fw fa-lock"></i></td>
                                    @endif
                                    <td>
                                        <a class="text-nowrap" href="{{ route('promocodes.event',['id'=>$event->id]) }}" title="Посмотреть промокоды по {{ $event->name_ru }}">
                                            {{ count($event->promocodes) }}
                                        </a>
                                    </td>
                                    <td><a href="/events/show/{{$event->id}}"><i class="fal fa-fw fa-eye"></i></a></td>
                                    <td><a href="/events/edit/{{$event->id}}"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/events/delete/{{$event->id}}"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $events->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
