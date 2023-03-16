<x-app head-title="Выставки">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-copyright text-secondary"></i>&nbsp;Выставки</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Статус
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('exhibitions') }}">Все</a></li>
                    <li><a class="dropdown-item" href="{{ route('exhibitions',['status'=>0]) }}">Активные</a></li>
                    <li><a class="dropdown-item" href="{{ route('exhibitions',['status'=>1]) }}">Черновики</a></li>
                </ul>
                <a href="/exhibitions/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список выставок | Всего: <strong>{{$total}}</strong>
                        @if( isset($filter_status) )
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> {{$filter_status}}</span>
                        @else
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> Все выставки</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name','Название')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('description','Описание')</th>
                                <th class="text-nowrap" scope="col"></th>
                                <th></th>
                                <th></th>
                                <th></th>
{{--                                <th></th>--}}
                                <th></th>
                                <th></th>
                                <th class="text-nowrap" scope="col">@sortablelink('template','Статус')</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exhibitions as $ex)
                                <tr class="{{ $ex->template==1?'table-secondary text-muted':'' }}">
                                    <th scope="row">{{ $ex->id }}</th>
                                    <td>{{ $ex->name }}</td>
                                    <td>{{ $ex->description }}</td>
                                    <td><a href="/cards/index?exhb={{$ex->name}}" title="Карточки посетителей привязанные к выставке: {{$ex->name}}"><i class="fal fa-fw fa-address-card"></i></a></td>
                                    <td><a href="/events/exhibition/{{$ex->id}}" title="Мероприятия по выставке: {{$ex->name}}"><i class="fal fa-fw fa-calendar-check"></i></a></td>
                                    <td><a href="/topics/exhibition/{{$ex->id}}" title="Специализации по выставке: {{$ex->name}}"><i class="fal fa-fw fa-briefcase"></i></a></td>
                                    <td><a href="/questionnaires/exhibition/{{$ex->id}}" title="Опросники по выставке: {{$ex->name}}"><i class="fal fa-fw fa-check-square"></i></a></td>
{{--                                    <td><a href="/promocodes/exhibition/{{$ex->id}}" title="Промокоды по выставке: {{$ex->name}}"><i class="fal fa-fw fa-brackets"></i></a></td>--}}
                                    <td><a href="/orders/exhibition/{{$ex->id}}" title="Заказы по выставке: {{$ex->name}}"><i class="fal fa-fw fa-shopping-cart"></i></a></td>
                                    <td><a href="/tickets/exhibition/{{$ex->id}}" title="Билеты по выставке: {{$ex->name}}"><i class="fal fa-fw fa-ticket"></i></a></td>
                                    <td class="{{$ex->template==0?'table-success':''}}">{{ $ex->template==0?'Активная':'Черновик' }}</td>
                                    <td><a href="/exhibitions/edit/{{ $ex->id }}"><i class="fal fa-fw fa-edit" title="Редактировать выставку"></i></a></td>
                                    <td><a href="/exhibitions/delete/{{ $ex->id }}" onclick="return confirm('Вы уверены, что хотите удалить выставку?')"><i class="fal fa-fw fa-trash-alt" title="Удалить выставку"></i></a></td>
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
