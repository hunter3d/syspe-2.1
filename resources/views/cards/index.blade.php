<x-app head-title="Карточки">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-address-card text-secondary"></i>&nbsp;Карточки посетителей</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставки
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('cards') }}">Все выставки</a></li>
                    @foreach($exhibitions as $exhb)
                        <li><a class="dropdown-item" href="{{ route('cards',['exhb'=>$exhb->name]) }}">{{ $exhb->name }}</a></li>
                    @endforeach


                </ul>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/cards/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Карточки посетителей | Всего: <strong>{{$total}}</strong>
                        @if( $filter_exhb )
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> {{ $filter_exhb }}</span>
                        @else
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> Все выставки</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-key"></i></th>
                                <th class="text-nowrap" scope="col">@sortablelink('last_name','Фамилия')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('first_name','Имя')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('second_name','Отчество')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('company','Компания')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('cardtopic_id','Специализация')</th>
                                <th class="text-nowrap" scope="col">Выставка</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-globe" title="Страна"></i></th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-envelope" title="Email-ы"></i></th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-phone" title="Телефоны"></i></th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-comment" title="Коментарии"></i></th>
                                <th class="text-nowrap" scope="col">Статус</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-shopping-cart" title="Заказов"></i></th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-ticket" title="Билетов"></i></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cards as $card)
                                <tr>
                                    <th scope="row">{{ $card->id }}</th>
                                    @if( $card->visitor_id == 0 )
                                        <td class="table-danger"><i class="fal fa-fw fa-user-slash"></i></td>
                                    @else
                                        <td class="table-success"><i class="fal fa-fw fa-user"></i></td>
                                    @endif
                                    <td>{{ $card->last_name }}</td>
                                    <td>{{ $card->first_name }}</td>
                                    <td>{{ $card->second_name }}</td>
                                    <td>{{ $card->company }}</td>
                                    <td>{{ $card->cardtopic->name_ru }}</td>
                                    <td>
                                        @php
                                            $exhibitions = $card->exhibitions;
                                            $string = '';
                                            foreach ($exhibitions as $exhibition) {
                                                $string .='<span class="badge text-bg-light me-1">'.$exhibition->name.'</span>';
                                            }
                                            echo $string;
                                        @endphp
                                    </td>
                                    <td>{{$card->cardcountry->code}}</td>
                                    <td>
                                        @php
                                            $emails = $card->emails;
                                            $string = '';
                                            foreach ($emails as $email) {
                                                $string .='<span class="badge text-bg-light me-1">'.$email->email.'</span>';
                                            }
                                            echo $string;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $phones = $card->phone;
                                            $string = '';
                                            foreach ($phones as $phone) {
                                                $string .='<span class="badge text-bg-light me-1">'.$phone->number.'</span>';
                                            }
                                            echo $string;
                                        @endphp
                                    </td>
                                    <td>{{ count( $card->comments ) }}</td>
                                    <td>{{ $card->status }}</td>
                                    <td>{{ $card->visitor->order?count($card->visitor->order):0 }}</td>
                                    <td>{{ $card->visitor->tickets?count($card->visitor->tickets    ):0 }}</td>
                                    <td><a href="/cards/show/{{$card->id}}" title="Открыть карточку"><i class="fal fa-fw fa-eye"></i></a></td>
                                    <td><a href="/cards/edit/{{$card->id}}" title="Редактировать"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/cards/delete/{{$card->id}}" title="Удалить" onclick="return confirm('Вы уверены, что хотите удалить карточку')"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $cards->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
