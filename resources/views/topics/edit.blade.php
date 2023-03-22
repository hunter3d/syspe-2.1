<x-app head-title="Редактировать специализацию">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-briefcase text-secondary"></i>&nbsp;Редактировать специализацию</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('topics') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Редактировать специализацию
                    </div>
                    <form action="/topics/edit/{{$topic->id}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="exhb" class="form-label">Выставка</label>
                                <select name="exhibition_id" id="exhb" class="form-select" aria-label="Выставка">
                                    @foreach($exhibitions as $exhb)
                                        <option {{$exhb->id==$topic->exhibition_id?'selected':''}} value="{{$exhb->id}}">{{$exhb->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_ua" class="form-label">Название на украинском</label>
                                <input name="name_ua" value="{{$topic->name_ua}}" type="text" class="form-control" id="name_ua" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_ru" class="form-label">Название на русском</label>
                                <input name="name_ru" value="{{$topic->name_ru}}" type="text" class="form-control" id="name_ru" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_en" class="form-label">Название на английском</label>
                                <input name="name_en" value="{{$topic->name_en}}" type="text" class="form-control" id="name_en" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="template" class="form-label">Статус</label>
                                <select name="template" id="template" class="form-select" aria-label="Статус">
                                    <option {{$topic->template == 0?'selected':''}} value="0">Активная</option>
                                    <option {{$topic->template == 1?'selected':''}} value="1">Черновик</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
