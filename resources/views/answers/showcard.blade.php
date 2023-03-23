<x-app head-title="Анкеты посетителей и карточки">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-question-square text-secondary"></i> Анкеты посетителей и карточки<small class="text-muted"> | {{$event->name_ru}}</small>
                </h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="#" class="btn btn-secondary" onclick="htmlTableToExcel('xlsx')">
                    Экспорт в Excel
                </a>
            </div>

            <script src="/js/xlsx.full.min.js"></script>

            <script>
                function htmlTableToExcel(type){
                    var data = document.getElementById('tblToExcl');
                    var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
                    XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
                    XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);
                }
            </script>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Анкеты и карточки | {{ $event->name_ru }} | Всего: <strong>{{count($answers)}}</strong>
                    </div>
                    <div class="table-responsive">
                        <table id="tblToExcl" class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Login</th>

                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Компания</th>
                                <th>Специализация</th>
                                <th>Должность</th>
                                <th>Телефоны</th>
                                <th>Email</th>
                                <th>Страна</th>
                                <th>Область</th>
                                <th>Район</th>
                                <th>Город</th>
                                <th>Улица</th>
                                <th>Дом</th>
                                <th>Офис</th>
                                <th>Индекс</th>
                                <th></th>
                                <th>Promocode</th>


                                @foreach($questions as $q)
                                    <th>{{ $q->question_ru }}</th>
                                @endforeach
{{--                                <th>promocode</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($answers as $answer)
                                <tr>
                                    <td>{{$answer->id}}</td>
                                    <td>
                                        <a href="/cards/{{($answer->visitor->card?'show/'.$answer->visitor->card->id:'index')}}">
                                            {{$answer->visitor->email}}
                                        </a>
                                    </td>

                                    <td>{{ $answer->visitor->card?$answer->visitor->card->last_name:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->first_name:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->second_name:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->company:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->topic->name_ru:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->position:'' }}</td>
                                    <td>
                                        @php
                                        if ($answer->visitor->card) {
                                            $phones = '';
                                            foreach ($answer->visitor->card->phone as $p)
                                                {
                                                    $phones .= str_replace(' ', '', $p->number).' ';
                                                }
                                            echo $phones;
                                        }
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            if ($answer->visitor->card) {
                                                $emails = '';
                                                foreach ($answer->visitor->card->emails as $e)
                                                    {
                                                        $emails .= '<a href="mailto:'.$e->email.'">'.$e->email.' </a>';
                                                    }
                                                echo $emails;
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->cardcountry->name_ru:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->region:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->district:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->city:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->street:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->house:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->office:'' }}</td>
                                    <td>{{ $answer->visitor->card?$answer->visitor->card->post_code:'' }}</td>
                                    <td class="text-nowrap">{{$answer->created_at}}</td>
                                    <td>
                                    @php
                                        $order = \App\Models\Orders::where('visitor_id',$answer->visitor_id)->where('event_id',$answer->event_id)->first();
                                        echo $order->promocode->code;
                                    @endphp
                                    </td>
                                    @foreach($questions as $q)
                                        <td>
                                            <?php
                                            $data = json_decode( $answer->data, true );
                                                if ( array_key_exists($q->question_ru, $data) ) {
                                                    if( is_array($data[$q->question_ru]) ) {
                                                        foreach ($data[$q->question_ru] as $str) {
                                                            print "$str, ";
                                                        }
                                                    } else {
                                                        echo $data[$q->question_ru];
                                                    }
                                                }
                                                if ( array_key_exists($q->question_ua, $data) ) {
                                                    if( is_array($data[$q->question_ua]) ) {
                                                        foreach ($data[$q->question_ua] as $str) {
                                                            print "$str, ";
                                                        }
                                                    } else {
                                                        echo $data[$q->question_ua];
                                                    }
                                                }
                                                if ( array_key_exists($q->question_en, $data) ) {
                                                    if( is_array($data[$q->question_en]) ) {
                                                        foreach ($data[$q->question_en] as $str) {
                                                            print "$str, ";
                                                        }
                                                    } else {
                                                        echo $data[$q->question_en];
                                                    }
                                                }
                                            ?>
                                        </td>
                                    @endforeach

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
