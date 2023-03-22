<x-app head-title="Создать специализацию">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-briefcase text-secondary"></i>&nbsp;Создать специализацию</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('topics') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новую специализацию
                    </div>
                    <form action="/topics/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="exhb" class="form-label">Выставка</label>
                                <select name="exhibition_id" id="exhb" class="form-select" aria-label="Выставка">
                                    @foreach($exhibitions as $exhb)
                                        <option value="{{$exhb->id}}">{{$exhb->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_ua" class="form-label">Название на украинском</label>
                                <input name="name_ua" type="text" class="form-control" id="name_ua" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_ru" class="form-label">Название на русском</label>
                                <input name="name_ru" type="text" class="form-control" id="name_ru" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="name_en" class="form-label">Название на английском</label>
                                <input name="name_en" type="text" class="form-control" id="name_en" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="template" class="form-label">Статус</label>
                                <select name="template" id="template" class="form-select" aria-label="Статус">
                                    <option value="0">Активная</option>
                                    <option value="1">Черновик</option>
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
