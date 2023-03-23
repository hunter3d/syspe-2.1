<x-app head-title="Анкеты посетителей">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-question-square text-secondary"></i> Анкеты посетителей<small class="text-muted"> | {{$event->name_ru}}</small>
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
                        Анкеты | {{ $event->name_ru }} | Всего: <strong>{{count($answers)}}</strong>
                    </div>
                    <div class="table-responsive">
                        <table id="tblToExcl" class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                @foreach($questions as $q)
                                    <th>{{ $q->question_ru }}</th>
                                @endforeach
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
