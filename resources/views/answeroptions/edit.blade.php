<x-app head-title="Редактировать вариант ответа">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-check-square text-secondary"></i>&nbsp;Редактировать вариант ответа</h1>
                <p>
                    <strong>Вопрос: </strong>{{ $answer->questionnaire->question_ru }}
                    <strong>Тип: </strong>{{ $answer->questionnaire->type }}
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
                    <form action="/answeroptions/edit/{{$answer->id}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="questionnaire_id" value="{{$answer->questionnaire->id}}">

                            <div class="col-12 mb-4">
                                <label for="answer_ua" class="form-label">Ответ UA</label>
                                <input value="{{$answer->answer_ua}}" name="answer_ua" type="text" class="form-control" id="answer_ua" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="answer_ru" class="form-label">Ответ RU</label>
                                <input value="{{$answer->answer_ru}}" name="answer_ru" type="text" class="form-control" id="answer_ru" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="answer_en" class="form-label">Ответ EN</label>
                                <input value="{{$answer->answer_en}}" name="answer_en" type="text" class="form-control" id="answer_en" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="order" class="form-label">Порядок</label>
                                <input name="order" type="text" class="form-control" id="order" value="1" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
