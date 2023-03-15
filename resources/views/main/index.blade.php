<x-app head-title="Главная">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-home text-secondary"></i>&nbsp;Главная</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/messages/add" class="btn btn-primary">
                    <i class="fal fa-fw fa-plus"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fal fa-fw fa-comment-alt-lines text-secondary"></i>
                        Информация
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach( $messages as $message )
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $message->name }}</h6>
                                    <small>{{ getFioById($message->user_id) }}</small>
                                </div>
                                <div>{{ $message->description }}</div>
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <small class="text-muted">{{ $message->created_at  }}</small>
                                    @if( $message->user_id == auth('web')->user()->id )
                                    <div>
                                        <a href="/messages/edit/{{$message->id}}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fal fa-fw fa-edit"></i>
                                        </a>
                                        <a href="/messages/delete/{{$message->id}}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fal fa-fw fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $messages->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app>
