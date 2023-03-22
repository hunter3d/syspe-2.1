<x-app head-title="Создать промокод">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-brackets text-secondary"></i>&nbsp;Создать промокод</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('promocodes') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новый промокод
                    </div>
                    <form action="/promocodes/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="event_id" class="form-label">Мероприятие</label>
                                <select name="event_id" id="event_id" class="form-select" aria-label="Мероприятие">
                                    @foreach($events as $event)
                                        <option value="{{$event->id}}">{{$event->name_ru.' ('. $event->start.' - '.$event->stop .')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="code" class="form-label">Промокод</label>
                                <input name="code" type="text" class="form-control" id="code" required aria-describedby="codeHelp">
                                <div id="codeHelp" class="form-text">Промокод генерируется автоматически. Но! Никто не мешает поменять его руками. При проверке, регистр букв не имеет значения. При вводе кода руками не используйте букву О и цифру 0! </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="price" class="form-label">Стоимость</label>
                                <div class="input-group">
                                    <span class="input-group-text">&#8372;</span>
                                    <input name="price" type="number" value="0" class="form-control text-end" id="price" required>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>

<script>
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    console.log(makeid(8));
    document.getElementById("code").value = makeid(8);
</script>
