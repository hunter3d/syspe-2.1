<x-app head-title="Логи">
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-file-alt text-secondary"></i>&nbsp;Логи</h1>
            </div>

            <div class="col-auto text-end ms-auto">

                <div class="dropdown">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fal fa-fw fa-backward"></i>
                    </a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fal fa-fw fa-filter"></i> Имя лога
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownFilter">
                        <li><a class="dropdown-item" href="/config/logs">Все</a></li>
                        @foreach($log_names as $ln)
                            <li><a class="dropdown-item" href="/config/logs/name/{{$ln->log_name}}">{{$ln->log_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Лог действий | Всего: <strong>{{ $total }}</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="col">@sortablelink('log_name','LogName')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('id','#')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('created_at','time')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('causer_id','causer_id')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('description','description')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('subject_type','subject_type')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('event','event')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('subject_id','subject_id')</th>
                                <th class="text-nowrap" scope="col">@sortablelink('properties','properties')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->log_name }}</td>
                                    <td>{{ $log->id }}</td>
                                    <td class="text-nowrap">{{ $log->created_at }}</td>
                                    <td>{{ ($log->causer_id ? getFioById($log->causer_id) : '---') }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->subject_type }}</td>
                                    <td>{{ $log->event }}</td>
                                    <td>{{ $log->subject_id }}</td>
                                    <td>{{ json_encode($log->properties, JSON_UNESCAPED_UNICODE) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $logs->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
