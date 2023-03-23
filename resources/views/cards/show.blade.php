<x-app head-title="Карточка посетителя">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3">
                    <i class="fal fa-fw fa-address-book text-secondary"></i> Карточка посетителя
                </h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-2 g-4">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        Карточка посетителя
                    </div>
                    <table class="table table-hover table-sm">
                        <tr>
                            <td class="text-end text-muted">Фамилия:</td>
                            <td>{{ $card->last_name }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Имя:</td>
                            <td>{{ $card->first_name }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Отчество:</td>
                            <td>{{ $card->second_name }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Компания:</td>
                            <td>{{ $card->company }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Специализация:</td>
                            <td>{{ $card->topic->name_ru }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Должность:</td>
                            <td>{{ $card->position }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Телефоны:</td>
                            <td>
                                @php
                                    $phones = '';
                                    foreach ($card->phones as $p)
                                        {
                                            $phones .= '<span class="badge text-bg-light me-1">'.$p->number.'</span>';
                                        }
                                    echo $phones;
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Email:</td>
                            <td>
                                @php
                                    $emails = '';
                                    foreach ($card->emails as $e)
                                        {
                                            $emails .= '<a href="mailto:'.$e->email.'" class="badge text-bg-light text-decoration-none me-1">'.$e->email.'</a>';
                                        }
                                    echo $emails;
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Выставка регистрации:</td>
                            <td>
                                @php
                                    $exhbs = '';
                                    foreach ($card->exhibitions as $ex)
                                        {
                                            $exhbs .= '<span class="badge text-bg-light me-1">'.$ex->name.'</span>';
                                        }
                                    echo $exhbs;
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Регистрация:</td>
                            <td>{{ $card->visitor_id==0?'Не зарегистрирован':'Зарегистрирован' }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Страна:</td>
                            <td>{{ $card->cardcountry->name_ru }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Область:</td>
                            <td>{{ $card->region }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Район:</td>
                            <td>{{ $card->district }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Город:</td>
                            <td>{{ $card->city }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Улица:</td>
                            <td>{{ $card->street }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Дом:</td>
                            <td>{{ $card->house }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Офис:</td>
                            <td>{{ $card->office }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Индекс:</td>
                            <td>{{ $card->post_code }}</td>
                        </tr>
                    </table>
                    <div class="card-footer">
                        <a href="/cards/edit/{{$card->id}}" class="btn btn-secondary"><i class="fal fa-fw fa-edit"></i> Редактировать</a>
                    </div>
                    <p class="text-muted text-end m-2">Изменена: {{$card->updated_at}}</p>
                </div>

            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        Аккаунт
                    </div>
                    <table class="table table-hover table-sm">
                        <tr>
                            <td class="text-end text-muted">Login:</td>
                            <td>{{ $card->visitor->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Подтвержден:</td>
                            <td>{{ $card->visitor->email_verified_at != NULL?$card->visitor->email_verified_at:'Не подтвержден' }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-muted">Заблокирован:</td>
                            <td>{{ $card->visitor->is_blocked == 0?'Не заблокирован':'Заблокирован' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Заказы
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Мероприятие</th>
                                    <th>Промокод</th>
                                    <th>Коментарий</th>
                                    <th>Цена</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $od)
                                <tr>
                                    <td>{{$od->id}}</td>
                                    <td>{{$od->event->name_ru}}</td>
                                    <td>{{$od->promocode?$od->promocode->code:''}}</td>
                                    <td>{{$od->promocode?$od->promocode->description:''}}</td>
                                    <td>{{$od->price}}</td>
                                    <td>{!! $od->status=='complete'?'<span class="text-success">Оплачено</span>':'<span class="text-danger">Не оплачено</span>'!!}</td>
                                    <td>{{$od->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Билеты
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Мероприятие</th>
                                <th>Код</th>
                                <th>Проверен</th>
                                <th><i class="fal fa-fw fa-download"></i></th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $tk)
                                <tr>
                                    <td>{{$tk->id}}</td>
                                    <td>{{$tk->event->name_ru}}</td>
                                    <td>{{$tk->code}}</td>
                                    <td>{{$tk->checked_at}}</td>
                                    <td><a href="{{ $tk->file }}" title="Скачать / Посмотреть билет"><i class="fal fa-fw fa-file-pdf"></i></a></td>
                                    <td>{{$od->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fal fa-fw fa-comment"></i> Коментарии
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @if( count($card->comments) > 0 )
                                @foreach($card->comments as $comment)
                                    <li class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="fw-bold mb-1">{{ getFioById( $comment->user_id ) }}</span>
                                            <a href="/cards/delcomment/{{ $comment->id }}">
                                                <i class="fal fa-fw fa-trash"></i>
                                            </a>
                                        </div>
                                        <p class="mb-1">{{$comment->message}}</p>
                                        <p class="text-end mb-0">
                                            <small class="text-muted">{{ $comment->created_at }}</small>
                                        </p>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item">
                                    Коментарии к карточке клиента отсутствуют.
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="/cards/addcomment/{{$card->id}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="comment" class="form-label">Добавить коментарий</label>
                                <textarea name="message" class="form-control" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary"><i class="fal fa-fw fa-comment-plus"></i> Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
