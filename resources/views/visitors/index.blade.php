<x-app head-title="Посетители">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-users text-secondary"></i>&nbsp;Посетители</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Статус
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('visitors') }}">Все посетители</a></li>
                    <li><a class="dropdown-item" href="{{ route('cards',['status'=>'verified']) }}">Подтвержденные</a></li>
                    <li><a class="dropdown-item" href="{{ route('cards',['status'=>'active']) }}">Активные</a></li>
                    <li><a class="dropdown-item" href="{{ route('cards',['status'=>'blocked']) }}">Заблокированные</a></li>
                </ul>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/visitors/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Посетители | Всего: <strong>{{ $total }}</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('email','Email')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('email_verified_at','Подтвержден')</th>
                                <th>ФИО</th>
                                <th>Компания</th>
                                <th>Должность</th>
                                <th>Выставки</th>
                                <th>@sortablelink('is_blocked','Статус')</th>
                                <th>Анкета</th>
                                <th><i class="fal fa-fw fa-shopping-cart"></i></th>
                                <th><i class="fal fa-fw fa-ticket"></i></th>
{{--                                <th class="text-nowrap" scope="col"></th>--}}
{{--                                <th class="text-nowrap" scope="col"></th>--}}
{{--                                <th class="text-nowrap" scope="col"></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($visitors as $visitor)
                                <tr>
                                    <th scope="row">{{ $visitor->id }}</th>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{!! $visitor->email_verified_at?$visitor->email_verified_at:'<span class="text-danger">Не подтвержден</span>' !!}</td>
                                    <td>{{ $visitor->card?$visitor->card->last_name.' '.$visitor->card->first_name.' '.$visitor->card->second_name:'' }}</td>
                                    <td>{{ $visitor->card?$visitor->card->company:'' }}</td>
                                    <td>{{ $visitor->card?$visitor->card->position:'' }}</td>
                                    <td>
                                        @if($visitor->card)
                                            @foreach($visitor->card->exhibitions as $exh)
                                                <span class="badge text-bg-light me-1">
                                                {{ $exh->name }}
                                            </span>
                                            @endforeach
                                        @endif
                                    </td>
                                    @if( $visitor->is_blocked == 0 )
                                        <td class="table-success"><i class="fal fa-fw fa-unlock"></i></td>
                                    @else
                                        <td class="table-danger"><i class="fal fa-fw fa-lock"></i></td>
                                    @endif

                                    @if( $visitor->card )
                                        <td class="table-success">
                                            <a href="{{ route('cards.show',['id'=>$visitor->card->id]) }}" title="Посмотреть карточку посетителя">
                                                <i class="fal fa-fw fa-address-card"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td class="table-danger">Отсутствует</td>
                                    @endif
                                    <td>{{ $visitor->order?count($visitor->order):'0' }}</td>
                                    <td>{{ $visitor->tickets?count($visitor->tickets):'0' }}</td>
{{--                                    <td><a href="/visitors/show/{{$visitor->id}}" title="Открыть посетителя"><i class="fal fa-fw fa-eye"></i></a></td>--}}
{{--                                    <td><a href="/visitors/edit/{{$visitor->id}}" title="Редактировать"><i class="fal fa-fw fa-edit"></i></a></td>--}}
{{--                                    <td><a href="/visitors/delete/{{$visitor->id}}" title="Удалить" onclick="return confirm('Вы уверены, что хотите удалить посетителя')"><i class="fal fa-fw fa-trash"></i></a></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $visitors->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
