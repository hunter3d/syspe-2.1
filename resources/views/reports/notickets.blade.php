<x-app head-title="Отчеты">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-address-card text-secondary"></i>&nbsp;Отчеты | <small>Зарегистрированы без заказанных билетов</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставки
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('reports.notickets') }}">Все выставки</a></li>
                    @foreach($exhibitions as $exhb)
                        <li><a class="dropdown-item" href="{{ route('reports.notickets',['exhb'=>$exhb->name]) }}">{{ $exhb->name }}</a></li>
                    @endforeach


                </ul>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="#" class="btn btn-secondary" onclick="htmlTableToExcel('xlsx')">
                    Экспорт в Excel
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Без заказанных билетов | Всего (по всем выставкам): <strong>{{ count($visitors) }}</strong>
                        @if( $fexhb )
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> {{ $fexhb }}</span>
                        @else
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> Все выставки</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="tblToExcl" class="table table-hover table-sm align-middle">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                    <th class="text-nowrap" scope="col">@sortablelink('email','email')</th>
                                    <th class="text-nowrap" scope="col">Фамилия</th>
                                    <th class="text-nowrap" scope="col">Имя</th>
                                    <th class="text-nowrap" scope="col">Отчество</th>
                                    <th>Телефоны</th>
                                    <th>Компания</th>
                                    <th>Должность</th>
                                    <th class="text-nowrap" scope="col">Выставка</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $v)
                                    @if ( $fexhb != NULL )
                                        @php
                                            $filter = 0;
                                            $es = $v->card->exhibitions;
                                            foreach ( $es as $e ) {
                                                if ( $e->name == $fexhb ) $filter = 1;
                                            }
                                        @endphp
                                    @endif
                                    @if($fexhb == NULL || $filter == 1)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->email }}</td>
                                        <td>{{ $v->card->last_name }}</td>
                                        <td>{{ $v->card->first_name }}</td>
                                        <td>{{ $v->card->second_name }}</td>
                                        <td>
                                            @php
                                                $phones = $v->card->phones;
                                                $string = '';
                                                foreach ($phones as $phone) {
                                                    $string .='<span class="badge text-bg-light me-1">'.$phone->number.'</span>';
                                                }
                                                echo $string;
                                            @endphp
                                        </td>
                                        <td>{{ $v->card->company }}</td>
                                        <td>{{ $v->card->position }}</td>
                                        <td>
                                            @php
                                                $exhibitions = $v->card->exhibitions;
                                                $string = '';
                                                foreach ($exhibitions as $exhibition) {
                                                    $string .='<span class="badge text-bg-light me-1">'.$exhibition->name.'</span>';
                                                }
                                                echo $string;
                                            @endphp
                                        </td>
                                        <td><a href="/cards/show/{{$v->card->id}}" title="Открыть карточку"><i class="fal fa-fw fa-eye"></i></a></td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
</x-app>
