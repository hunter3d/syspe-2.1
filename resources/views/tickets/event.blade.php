<x-app head-title="Билеты | {{ $evnt->name_ru }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-ticket text-secondary"></i>&nbsp;Билеты | <small>{{ $evnt->name_ru }}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEx" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставка
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEx">
                    <li><a class="dropdown-item" href="{{ route('tickets') }}">Все</a></li>
                    @foreach($exhibitions as $exhibition)
                        <li><a class="dropdown-item" href="{{ route('tickets.exhibition',['id'=>$exhibition->id]) }}">{{$exhibition->name}}</a></li>
                    @endforeach
                </ul>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEv" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Мероприятие
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEv">
                    <li><a class="dropdown-item" href="{{ route('tickets') }}">Все</a></li>
                    @foreach($events as $event)
                        <li><a class="dropdown-item" href="{{ route('tickets.event',['id'=>$event->id]) }}">{{$event->name_ru}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Билеты | {{ $evnt->name_ru }} | Всего: <strong>{{ $total }}</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                    <th class="text-nowrap" scope="col">@sortablelink('visitor.email','Посетитель')</th>
                                    <th>ФИО</th>
                                    <th>Компания</th>
                                    <th>Должность</th>
                                    <th style="text-align: center"><i class="fal fa-fw fa-brackets"></i></th>
                                    <th></th>
                                    <th class="text-nowrap" scope="col">@sortablelink('event.name_ru','Мероприятие')</th>
                                    <th class="text-nowrap" scope="col">@sortablelink('code','Штрихкод')</th>
                                    <th class="text-nowrap" style="text-align: center" scope="col"><i class="fal fa-fw fa-barcode-read"></i></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $tickets as $ticket )
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->visitor->email }}</td>
                                    <td>{{ $ticket->visitor->card?$ticket->visitor->card->last_name.' '.$ticket->visitor->card->first_name.' '.$ticket->visitor->card->second_name:'' }}</td>
                                    <td>{{ $ticket->visitor->card?$ticket->visitor->card->company:'' }}</td>
                                    <td>{{ $ticket->visitor->card?$ticket->visitor->card->position:'' }}</td>
                                    <td>{{ $ticket->order&&$ticket->order->promocode?$ticket->order->promocode->code:'' }}</td>
                                    <td>{{ $ticket->order&&$ticket->order->promocode?$ticket->order->promocode->description:'' }}</td>
                                    <td>{{ $ticket->event->name_ru }}</td>
                                    <td>{{ $ticket->code }}</td>
                                    <td class="{{$ticket->checked_at?'table-success':''}}">{{ $ticket->checked_at }}</td>
                                    <td><a href="{{ route('cards.show',['id'=>($ticket->visitor->card?$ticket->visitor->card->id:0)]) }}" title="Посмотреть карточку"><i class="fal fa-fw fa-address-card"></i></a></td>
                                    <td><a href="{{ $ticket->file }}" title="Скачать / Посмотреть билет"><i class="fal fa-fw fa-file-pdf"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $tickets->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
