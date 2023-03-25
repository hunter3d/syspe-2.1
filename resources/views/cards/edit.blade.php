<x-app head-title="Редактировать карточку">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-address-card text-secondary"></i>&nbsp;Редактировать карточку посетителя</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Редактировать карточку посетителя | <small class="text-mutted">{!! $card->visitor_id==0?'Аккаунт не зарегистрирован. <a href="/visitors/create">Создать</a>':'Привязан аккаунт: <a href="/visitors/show/'.$card->visitor->id.'">'.$card->visitor->email.'</a>'!!}</small>
                    </div>
                    <form action="/cards/edit/{{$card->id}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="row row-cols-1">
                                <div class="col-12 mb-4">
                                    <label for="exhibitions" class="form-label">Выставки</label>
                                    <input name="exhibitions" class="form-control" id="exhibitions" aria-describedby="exhibitionsHelp" value="{{$exhibitions}}">
                                    <div id="exhibitionsHelp" class="form-text">Привязка к выставкам.</div>
                                </div>
                                <link rel="stylesheet" href="/css/amsify.suggestags.css">
                                <script src="/js/jquery.amsify.suggestags.js"></script>
                                <script>
                                    $('input[name="exhibitions"]').amsifySuggestags({
                                        delimiters:[','],
                                        type :'amsify',
                                        suggestions: [<?php echo '"'.implode('","', preg_replace('/[^a-zA-Z0-9а-яА-Я ]/u','',$all_exhibitions)).'"' ?>],
                                        whiteList: true,
                                    });
                                </script>
                            </div>
                            <div class="col-12 mb-4">
                                @foreach($card->emails as $email)
                                    <div class="btn-group mb-3">
                                        <a href="mailto:{{$email->email}}" type="button" class="btn btn-outline-secondary text-black"><i class="fal fa-fw fa-envelope text-muted"></i> {{$email->email}}</a>
                                        <a href="/cards/delemail/{{$email->id}}/{{$card->visitor_id}}" class="btn btn-secondary"><i class="fal fa-fw fa-trash"></i></a>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#emailModal">
                                    +<i class="fal fa-fw fa-envelope"></i>
                                </button>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-4">
                                <div class="col-auto mb-4">
                                    <label for="last_name" class="form-label">Фамилия</label>
                                    <input name="last_name" value="{{$card->last_name}}" type="text" class="form-control" id="last_name">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="first_name" class="form-label">Имя</label>
                                    <input name="first_name" value="{{$card->first_name}}" type="text" class="form-control" id="first_name">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="second_name" class="form-label">Отчество</label>
                                    <input name="second_name" value="{{$card->second_name}}" type="text" class="form-control" id="second_name">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                @foreach($card->phones as $phone)
                                    <div class="btn-group mb-3">
                                        <a href="tel:{{$phone->number}}" type="button" class="btn btn-outline-secondary text-black" disabled><i class="fal fa-fw fa-phone text-muted"></i> {{$phone->number}}</a>
                                        <a href="/cards/delphone/{{$phone->id}}" class="btn btn-secondary"><i class="fal fa-fw fa-trash"></i></a>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#phoneModal">
                                    +<i class="fal fa-fw fa-phone"></i>
                                </button>

                            </div>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

                                <div class="col-auto mb-4">
                                    <label for="company" class="form-label">Компания</label>
                                    <input name="company" value="{{$card->company}}" type="text" class="form-control" id="company">
                                </div>

                                <div class="col-auto mb-4">
                                    <label for="position" class="form-label">Должность</label>
                                    <input name="position" value="{{$card->position}}" type="text" class="form-control" id="position">
                                </div>

                                <div class="col-auto mb-4">
                                    <label for="topic_id" class="form-label">Профиль деятельности</label>
                                    <select name="topic_id" id="topic_id" class="form-select" aria-label="Профиль деятельности">
                                        @foreach( $topics as $topic)
                                            <option {{$card->topic_id==$topic->id?'selected':''}} value="{{$topic->id}}">
                                                {{$topic->name_ru}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-4">
                                <div class="col-12 mb-4">
                                    <label for="country_id" class="form-label">Страна</label>
                                    <select name="country_id" id="country_id" class="form-select" aria-label="Страна">
                                        @foreach( $countries as $country)
                                            <option {{$card->country_id==$country->id?'selected':''}} value="{{$country->id}}">
                                                {{$country->name_ru.' ('.$country->code.')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="city" class="form-label">Город</label>
                                    <input name="city" value="{{$card->city}}" type="text" class="form-control" id="city">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="region" class="form-label">Область</label>
                                    <input name="region" value="{{$card->region}}" type="text" class="form-control" id="region">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="district" class="form-label">Район</label>
                                    <input name="district" value="{{$card->district}}" type="text" class="form-control" id="district">
                                </div>


                            </div>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4    ">
                                <div class="col-auto mb-4">
                                    <label for="street" class="form-label">Улица</label>
                                    <input name="street" value="{{$card->street}}" type="text" class="form-control" id="street">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="house" class="form-label">Дом</label>
                                    <input name="house" value="{{$card->house}}" type="text" class="form-control" id="house">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="office" class="form-label">Офис</label>
                                    <input name="office" value="{{$card->office}}" type="text" class="form-control" id="office">
                                </div>
                                <div class="col-auto mb-4">
                                    <label for="post_code" class="form-label">Индекс</label>
                                    <input name="post_code" value="{{$card->post_code}}" type="text" class="form-control" id="post_code">
                                </div>

                            </div>

                            <div class="col-12 mb-4">
                                <label for="status" class="form-label">Статус</label>
                                <select name="status" id="status" class="form-select" aria-label="Статус карточки">
                                    <option {{$card->status=='Новая'?'selected':''}} value="Новая">Новая карточка</option>
                                    <option {{$card->status=='Проверена'?'selected':''}} value="Проверена">Карточка проверена</option>
                                    <option {{$card->status=='Отключена'?'selected':''}} value="Отключена">Карточка отключена</option>
                                    <option {{$card->status=='Старая'?'selected':''}} value="Старая">Старая карточка</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="phoneModal" tabindex="-1" aria-labelledby="phoneModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="phoneModalLabel">Добавить телефон</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/cards/addphone/{{$card->id}}">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-fw fa-phone"></i></span>
                                            <input id="phoneInput" name="number" type="text" class="form-control" placeholder="380441234567" aria-label="Номер" aria-describedby="basic-addon1">
                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        const myModal = document.getElementById('phoneModal')
                        const myInput = document.getElementById('phoneInput')
                        myModal.addEventListener('shown.bs.modal', () => {
                            myInput.focus()
                        })
                    </script>

                    <!-- Modal -->
                    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="emailModalLabel">Добавить email</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/cards/addemail/{{$card->id}}">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"><i class="fal fa-fw fa-envelope"></i></span>
                                            <input id="emailInput" name="email" type="text" class="form-control" placeholder="user@domain.com" aria-label="Email" aria-describedby="basic-addon2">
                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        const myModal2 = document.getElementById('emailModal')
                        const myInput2 = document.getElementById('emailInput')
                        myModal2.addEventListener('shown.bs.modal', () => {
                            myInput2.focus()
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app>
