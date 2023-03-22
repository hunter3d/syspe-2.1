<x-app head-title="Редактировать промокод">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-brackets text-secondary"></i>&nbsp;Редактировать промокод</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Редактировать промокод
                    </div>
                    <form action="/promocodes/edit/{{$promocode->id}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="event_id" class="form-label">Мероприятие</label>
                                <select name="event_id" id="event_id" class="form-select" aria-label="Мероприятие">
                                    @foreach($events as $event)
                                        <option value="{{$event->id}}" {{($event->id==$promocode->id?'selected':'')}}>{{$event->name_ru.' ('. $event->start.' - '.$event->stop .')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="code" class="form-label">Промокод</label>
                                <input value="{{$promocode->code}}" name="code" type="text" class="form-control" id="code" required aria-describedby="codeHelp">
                                <div id="codeHelp" class="form-text">Промокод генерируется автоматически. Но! Никто не мешает поменять его руками. При проверке, регистр букв не имеет значения. При вводе кода руками не используйте букву О и цифру 0! </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" class="form-control" id="description" rows="4">{{$promocode->description}}</textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-auto">
                                    <label for="price_uah" class="form-label">Стоимость ГРН</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fal fa-hryvnia"></i></span>
                                        <input name="price_uah" type="number" value="{{$promocode->price_uah}}" class="form-control text-end" id="price_uah" required>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label for="price_euro" class="form-label">Стоимость EURO</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fal fa-euro-sign"></i></span>
                                        <input name="price_euro" type="number" value="{{$promocode->price_euro}}" class="form-control text-end" id="price_euro" required>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label for="price_usd" class="form-label">Стоимость USD</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fal fa-dollar-sign"></i></span>
                                        <input name="price_usd" type="number" value="{{$promocode->price_usd}}" class="form-control text-end" id="price_usd" required>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
