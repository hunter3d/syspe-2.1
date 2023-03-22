<x-app head-title="Сканер">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-barcode text-secondary"></i>&nbsp;Сканер</h1>
            </div>
            <div class="col-auto ms-auto text-end">

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>

            </div>

            <div>
                <label for="event" class="form-label">Мероприятие</label>
                <select
                    name="event_id"
                    id="event"
                    class="form-select"
                    aria-label="Мероприятие"
                    aria-describedby="eventHelp"
                    onchange="setEvent(this)"
                >
                    <option value="0">Мероприятие не выбрано</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name_ru}}</option>
                    @endforeach
                </select>
                <div id="eventHelp" class="form-text">Обязательно укажите мероприятие, для которого будет производится
                    сканирование. В противном случае сканер не заработает
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-8 col-lg-6 mt-3">
                <div id="hardreader" style="display: none">
                    <label for="hardreader_input" class="form-label">Билет</label>
                    <input type="text" class="form-control" id="hardreader_input">
                </div>
                <div id="reader" width="320px" height="320"></div>
                <div class="btn-group col-12 mt-3">
                    <a href="#" class="btn btn-primary col-6" onclick="doStart()">
                        <i class="fal fa-fw fa-barcode"></i> Сканировать телефоном
                    </a>
                    <a href="#" class="btn btn-outline-primary col-6" onclick="doStartHard()">
                        <i class="fal fa-fw fa-barcode"></i> Сканировать сканером
                    </a>
                    <a href="#" class="btn btn-secondary col-6" onclick="doStop()">
                        <i class="fal fa-fw fa-stop"></i> Стоп и очистка
                    </a>
                </div>
            </div>
            <div id="info_block" class="col-12 col-md-8 card mt-3">
                {{-- put visitor info here --}}
            </div>
        </div>
    </div>

    <script src="/js/html5-qrcode.min.js"></script>
    <script>
        let event_id = null;
        let code = null;
        let data = null;
        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            console.log(`Code matched = ${decodedText}`, decodedResult);
            code = `${decodedText}`;
            doStop();
            showInfo();
        };
        const config = {fps: 10, qrbox: {width: 240, height: 240}};


        function doStart() {
            if (event_id !== null && event_id != 0) {
                removeInfo();
                html5QrCode.start({facingMode: "environment"}, config, qrCodeSuccessCallback);
            }
        }

        function doStartHard() {
            if (event_id !== null && event_id != 0) {
                removeInfo();
                document.getElementById('hardreader').style.display = 'block';
                document.getElementById('hardreader_input').focus();

                var element = document.getElementById('hardreader_input');
                element.addEventListener('input', function () {
                    // input value
                    if (element.value.length === 13) {
                        //console.log(element.value);
                        code = element.value;
                        // сбрасываем значение
                        element.value = '';
                        doStopHard();
                        showInfo();
                    }

                });
            }
        }

        function checkInputField() {
            alert('Horray! Someone wrote "' + this.value + '"!');
        }

        function doStop() {
            code = null;
            doStopHard();
            removeInfo();
            html5QrCode.stop().then((ignore) => {
                // QR Code scanning is stopped.
            }).catch((err) => {
                // Stop failed, handle it.
            });

        }

        function doStopHard() {
            document.getElementById('hardreader').style.display = 'none';
        }

        function setEvent(selectObject) {
            if (selectObject.value == 0) {
                event_id = null;
            } else {
                event_id = selectObject.value;
            }
            console.log(event_id)
            console.log('{{url('/')}}/scaner/' + event_id + '/' + code);
        }

        function showInfo() {
            $.ajax({
                url: "/tickets/check",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "event_id": event_id,
                    "code": code,
                },
                success: function (response) {
                    data = response;
                    putInfo( data );
                },
            });
        }

        function putInfo( data ) {
            const el = document.getElementById('info_block');
            if ( data.status === 'ok') {
                el.innerHTML =
                    `
                <div class="card-body">
                    <h5 class="card-header">Информация о посетителе</h5>
                    <div class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">
                                <strong>Билет</strong>
                                <span>Действительный</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Мероприятие</strong>
                                <span>${data.ticket.event.name_ru}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Email</strong>
                                <span>${data.visitor.email}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Фамилия</strong>
                                <span>${(data.visitor.card?data.visitor.card.last_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Имя</strong>
                                <span>${(data.visitor.card?data.visitor.card.first_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Отчество</strong>
                                <span>${(data.visitor.card?data.visitor.card.second_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Компания</strong>
                                <span>${(data.visitor.card?data.visitor.card.company:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Должность</strong>
                                <span>${(data.visitor.card?data.visitor.card.position:'- нет карточки -')}</span>
                            </li>

                        </ul>
                    </div>
                </div>
                `;
            } else if ( data.status === 'checked' ) {
                el.innerHTML =
                    `
                <div class="card-body">
                    <h5 class="card-header">Информация о посетителе</h5>
                    <div class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-center">
                                <strong>Билет</strong>
                                <span>Уже зарегистрирован</span>
                            </li>
                            <li class="list-group-item list-group-item-warning d-flex justify-content-between align-items-center">
                                <strong>Билет был зарегистрирован</strong>
                                <span>${data.ticket.checked_at}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Мероприятие</strong>
                                <span>${data.ticket.event.name_ru}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Email</strong>
                                <span>${data.visitor.email}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Фамилия</strong>
                                <span>${(data.visitor.card?data.visitor.card.last_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Имя</strong>
                                <span>${(data.visitor.card?data.visitor.card.first_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Отчество</strong>
                                <span>${(data.visitor.card?data.visitor.card.second_name:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Компания</strong>
                                <span>${(data.visitor.card?data.visitor.card.company:'- нет карточки -')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Должность</strong>
                                <span>${(data.visitor.card?data.visitor.card.position:'- нет карточки -')}</span>
                            </li>

                        </ul>
                    </div>
                </div>
                `;
            } else {
                el.innerHTML =
                    `
                    <div class="card-body">
                    <h5 class="card-header">Информация о посетителе</h5>
                    <div class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-center">
                                <strong>Билет</strong>
                                <span>С таким номером не существует</span>
                            </li>
                        </ul>
                    </div>
                    `;
            }
        }

        function removeInfo() {
            const eld = document.getElementById('info_block');
            eld.innerHTML = '';
        }
    </script>
</x-app>
