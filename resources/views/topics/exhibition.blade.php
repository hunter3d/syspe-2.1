<x-app head-title="Специализация | {{$exhb->name}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-briefcase text-secondary"></i>&nbsp;Специализация | <small>{{ $exhb->name }}</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilterEx" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Выставка
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('topics') }}">Все</a></li>
                    @foreach($exhibitions as $exhibition)
                        <li><a class="dropdown-item" href="{{ route('topics.exhibition',['id'=>$exhibition->id]) }}">{{$exhibition->name}}</a></li>
                    @endforeach
                </ul>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fal fa-fw fa-filter"></i> Статус
                </button>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownFilter">
                    <li><a class="dropdown-item" href="{{ route('topics.exhibition',['id'=>$exhb->id]) }}">Все</a></li>
                    <li><a class="dropdown-item" href="{{ route('topics.exhibition',['id'=>$exhb->id,'template'=>0]) }}">Активные</a></li>
                    <li><a class="dropdown-item" href="{{ route('topics.exhibition',['id'=>$exhb->id,'template'=>1]) }}">Черновики</a></li>
                </ul>
                <a href="/topics/add" class="btn btn-primary">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Список специализаций | {{ $exhb->name }}
                        @if( isset($filter_status) )
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> {{$filter_status}}</span>
                        @else
                            <span class="badge bg-secondary"><i class="fal fa-fw fa-filter"></i> Все</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('exhibition->name','Выставка')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_ua','Название UA')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_ru','Название RU')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('name_en','Название EN')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('template','Статус')</th>
                                <th class="text-nowrap" scope="col"></th>
                                <th class="text-nowrap" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topics as $topic)
                                <tr class="{{ $topic->template==1?'table-light text-muted':'' }}">
                                    <th scope="row">{{ $topic->id }}</th>
                                    <td>{{ ($topic->exhibition_id == 0?'не установлено':$topic->exhibition->name) }}</td>
                                    <td>{{ $topic->name_ua }}</td>
                                    <td>{{ $topic->name_ru }}</td>
                                    <td>{{ $topic->name_en }}</td>
                                    <td class="{{$topic->template==0?'table-success':''}}">{{ $topic->template==0?'Активная':'Черновик' }}</td>
                                    <td><a href="/topics/edit/{{$topic->id}}"><i class="fal fa-fw fa-edit"></i></a></td>
                                    <td><a href="/topics/delete/{{$topic->id}}" onclick="return confirm('Вы уверены, что хотите удалить специализацию? Все карточки, которые ее используют, будут изменены на: <Нет рубрики>')"><i class="fal fa-fw fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $topics->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
