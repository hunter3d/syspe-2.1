<x-app head-title="Мероприятиe">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-calendar-check text-secondary"></i>&nbsp;Мероприятиe <small class="text-muted">"{{$event->name_ru}}"</small></h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('events') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
                <a href="/events/edit/{{ $event->id }}" class="btn btn-primary">
                    <i class="fal fa-fw fa-edit"></i>
                </a>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-4 g-4">
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-header">
                        <small class="text-muted">На украинском</small>
                    </div>
                    <img src="{{'/'.$event->logo_path.'/'.$event->logo_name}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name_uk}}</h5>
                        <p class="card-text">{{$event->description_uk}}</p>
                        <p class="card-text">{{$event->location_uk}}</p>

                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{$event->price_uah}} грн.</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-header">
                        <small class="text-muted">На русском</small>
                    </div>
                    <img src="{{'/'.$event->logo_path.'/'.$event->logo_name}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name_ru}}</h5>
                        <p class="card-text">{{$event->description_ru}}</p>
                        <p class="card-text">{{$event->location_ru}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{$event->price}} грн.</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-header">
                        <small class="text-muted">На английском</small>
                    </div>
                    <img src="{{'/'.$event->logo_path.'/'.$event->logo_name}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name_en}}</h5>
                        <p class="card-text">{{$event->description_en}}</p>
                        <p class="card-text">{{$event->location_en}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{$event->price}} UAH.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
