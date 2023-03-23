<x-app head-title="Создать опросник">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-check-square text-secondary"></i>&nbsp;Создать опросник</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('questionnaires') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новый вопрос
                    </div>
                    <form action="/questionnaires/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="exhibition_id" class="form-label">Выставка</label>
                                <select name="exhibition_id" id="exhibition_id" class="form-select" aria-label="Тип элемента">
                                    <option selected>не выбрано</option>
                                    @foreach($exhibitions as $exhibition)
                                    <option value="{{ $exhibition->id }}">{{$exhibition->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="type" class="form-label">Тип</label>
                                <select name="type" id="type" class="form-select" aria-label="Тип элемента">
                                    <option value="textfield">textfield</option>
                                    <option value="select">select</option>
                                    <option value="checkbox">checkbox</option>
                                    <option value="radio">radio</option>
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="question_uk" class="form-label">Вопрос UA</label>
                                <input name="question_uk" type="text" class="form-control" id="question_uk" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="question_ru" class="form-label">Вопрос RU</label>
                                <input name="question_ru" type="text" class="form-control" id="question_ru" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="question_en" class="form-label">Вопрос EN</label>
                                <input name="question_en" type="text" class="form-control" id="question_en" required>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="template" class="form-label">Статус</label>
                                <select name="template" id="template" class="form-select" aria-label="Статус">
                                    <option value="0">Активный</option>
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
