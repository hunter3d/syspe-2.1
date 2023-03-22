<x-app head-title="Промокоды | {{$evnt->name_ru}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-brackets text-secondary"></i>&nbsp;Промокоды | <small>{{$evnt->name_ru}}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEx" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Мероприятие
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEx">
                    <li><a class="dropdown-item" href="{{ route('promocodes') }}">Все</a></li>
                    @foreach($events as $event)
                        <li><a class="dropdown-item" href="{{ route('promocodes.event',['id'=>$event->id]) }}">{{$event->name_ru}}</a></li>
                    @endforeach
                </ul>
                <a href="/promocodes/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список промокодов  | {{$evnt->name_ru}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('event.name_ru','Мероприятие')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('code','Промокод')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('description','Описание')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_uah','Цена ГРН')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_euro','Цена EURO')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_usd','Цена USD')</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-shopping-cart"></i></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promocodes as $promocode)
                                <tr>
                                    <th scope="row">{{ $promocode->id }}</th>
                                    <td>{{ $promocode->event->name_ru .' ('. $promocode->event->start.' - '.$promocode->event->stop .')' }}</td>
                                    <td>{{ $promocode->code }}</td>
                                    <td>{{ $promocode->description }}</td>
                                    <td>{{ $promocode->price_uah }}</td>
                                    <td>{{ $promocode->price_euro }}</td>
                                    <td>{{ $promocode->price_usd }}</td>
                                    <td>{{ count($promocode->orders) }}</td>
                                    <td><a href="/promocodes/edit/{{$promocode->id}}"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/promocodes/delete/{{$promocode->id}}"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $promocodes->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
