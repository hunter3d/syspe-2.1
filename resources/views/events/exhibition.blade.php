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
                                <th class="text-nowrap" scope="col">@sortablelink('exhibition.name','Выставка')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_ru','Название RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('description_ru','Описание RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('location_ru','Место проведения RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('start','Начало')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('start','Конец')</th>

                                <th class="text-nowrap" scope="col">@sortablelink('can_promo','promo')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('can_card','card')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('can_invoice','invoice')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('pay_uah',new Illuminate\Support\HtmlString('<i class="fal fa-hryvnia"></i>'))</th>
                                <th class="text-nowrap" scope="col">@sortablelink('pay_euro',new Illuminate\Support\HtmlString('<i class="fal fa-euro-sign"></i>'))</th>
                                <th class="text-nowrap" scope="col">@sortablelink('pay_usd',new Illuminate\Support\HtmlString('<i class="fal fa-dollar-sign"></i>'))</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_uah','Грн')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_euro','Евро')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_usd','Usd')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('template','Ч')</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-brackets"></i></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class="{{ $event->template==1?'table-secondary text-muted':'' }}">
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->exhibition->name }}</td>
                                    <td>{{ $event->name_ru }}</td>
                                    <td>{{ $event->description_ru }}</td>
                                    <td>{{ $event->location_ru }}</td>
                                    <td>{{ $event->start }}</td>
                                    <td>{{ $event->stop }}</td>

                                    <td><i class="fal {{ $event->can_promo==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td><i class="fal {{ $event->can_card==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td><i class="fal {{ $event->can_invoice==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td><i class="fal {{ $event->pay_uah==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td><i class="fal {{ $event->pay_euro==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td><i class="fal {{ $event->pay_usd==1?'fa-plus text-success':'fa-minus text-danger' }}"></i></td>
                                    <td>{{ $event->price_uah }}</td>
                                    <td>{{ $event->price_euro }}</td>
                                    <td>{{ $event->price_usd }}</td>
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
