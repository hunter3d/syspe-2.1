<x-app head-title="Создать вариант ответа">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-check-square text-secondary"></i>&nbsp;Создать вариант ответа</h1>
                <p>
                    <strong>Вопрос: </strong>{{ $question->question_ru }}
                    <strong>Тип: </strong>{{ $question->type }}
                </p>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новый ответ
                    </div>
                    <form action="/answeroptions/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="questionnaire_id" value="{{$question->id}}">

                            <div class="col-12 mb-4">
                                <label for="answer_ua" class="form-label">Ответ UA</label>
                                <input name="answer_ua" type="text" class="form-control" id="answer_ua" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="answer_ru" class="form-label">Ответ RU</label>
                                <input name="answer_ru" type="text" class="form-control" id="answer_ru" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="answer_en" class="form-label">Ответ EN</label>
                                <input name="answer_en" type="text" class="form-control" id="answer_en" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="order" class="form-label">Порядок</label>
                                <input name="order" type="text" class="form-control" id="order" value="1" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
