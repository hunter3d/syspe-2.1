<x-app head-title="Заказы | {{ $exhb->name }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-shopping-cart text-secondary"></i>&nbsp;Заказы | <small>{{ $exhb->name }}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEx" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставка
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEx">
                    <li><a class="dropdown-item" href="{{ route('orders') }}">Все</a></li>
                    @foreach($exhibitions as $exhibition)
                        <li><a class="dropdown-item" href="{{ route('orders.exhibition',['id'=>$exhibition->id]) }}">{{$exhibition->name}}</a></li>
                    @endforeach
                </ul>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEv" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Мероприятие
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilterEv">
                    <li><a class="dropdown-item" href="{{ route('orders') }}">Все</a></li>
                    @foreach($events as $event)
                        <li><a class="dropdown-item" href="{{ route('orders.event',['id'=>$event->id]) }}">{{$event->name_ru}}</a></li>
                    @endforeach
                </ul>
                <a href="#" class="btn btn-secondary" onclick="htmlTableToExcel('xlsx')">
                    <i class="fal fa-fw fa-file-excel"></i> Экспорт в Excel
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список заказов | {{ $exhb->name }} | Всего: <strong>{{ $total }}</strong>
                    </div>
                    <div class="table-responsive">
                        <table id="tblToExcl" class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('number','Счет')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('visitor_id','Посетитель')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('exhibition_id','Выставка')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('event_id','Мероприятие')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('promocode_id','Промокод')</th>
                                <th class="text-nowrap" scope="col">Описание</th>
                                <th class="text-nowrap" scope="col">@sortablelink('pay_method','Способ оплаты')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('currency->name_ru','Валюта')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('price_usd','Цена')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('created_at','Дата')</th>
                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-ticket"></i></th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->number }}</td>
                                    <td><a href="{{ $order->visitor&&$order->visitor->card?'/cards/show/'.$order->visitor->card->id:'#' }}" title="Посмотреть карточку">{{ $order->visitor?$order->visitor->email:'---' }}</a></td>
                                    <td>{{ $order->exhibition->name }}</td>
                                    <td>{{ $order->event->name_ru }}</td>
                                    <td>{{ $order->promocode_id==0?'не использовался':$order->promocode->code }}</td>
                                    <td>{{ $order->promocode_id==0?'':$order->promocode->description }}</td>
                                    <td>{{ $order->pay_method }}</td>
                                    <td>{{ $order->currency->name_ru }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->ticket?1:0 }}</td>
                                    <td class="{{$order->status=='complete'?'text-bg-success':''}}{{$order->status=='false'?'text-bg-danger':''}}">{{ ($order->status=='complete'?'Оплачен':'Не оплачен') }}</td>
                                    <td><a href="/orders/delete/{{$order->id}}"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $orders->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script>
        function htmlTableToExcel(type){
            var data = document.getElementById('tblToExcl');
            var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
            XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);
        }
    </script>
</x-app>
