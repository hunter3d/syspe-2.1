<x-app head-title="Создать мероприятие">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-calendar-check text-secondary"></i>&nbsp;Создать мероприятие</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('events') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новое мероприятие
                    </div>
                    <form action="/events/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="exhb" class="form-label">Выставка</label>
                                <select name="exhb" id="exhb" class="form-select" aria-label="Выставка">
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
                                <label for="description_ua" class="form-label">Описание на украинском</label>
                                <textarea name="description_ua" class="form-control" id="description_ua" rows="4" required></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description_ru" class="form-label">Описание на русском</label>
                                <textarea name="description_ru" class="form-control" id="description_ru" rows="4" required></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description_en" class="form-label">Описание на английском</label>
                                <textarea name="description_en" class="form-control" id="description_en" rows="4" required></textarea>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="location_ua" class="form-label">Место проведения на украинском</label>
                                <textarea name="location_ua" class="form-control" id="location_ua" rows="2"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="location_ru" class="form-label">Место проведения на русском</label>
                                <textarea name="location_ru" class="form-control" id="location_ru" rows="2"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="location_en" class="form-label">Место проведения на английском</label>
                                <textarea name="location_en" class="form-control" id="location_en" rows="2"></textarea>
                            </div>

                            {{-- Input LOGO image --}}
                            <div class="d-flex justify-content-center w-100">
                                <div class="col-6 mb-4 d-flex justify-content-center">
                                    <img class="img-fluid new_logo" src="/storage/templates/pe_event_template.svg" alt="Event logo" id="event_logo">
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="logo" class="form-label">Логотип</label>
                                <input name="logo" class="form-control" type="file" id="logo" aria-describedby="logoHelp" onchange="loadFile(event)" accept="image/png, image/jpeg">
                                <div id="logoHelp" class="form-text">Логотип мероприятия в формате PNG или JPG. В пропорции 3х2.</div>
                            </div>

                            <script type="text/javascript" src="{{asset('js/jquery.Jcrop.min.js')}}"></script>
                            <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}">
                            <script>
                                var loadFile = function(event) {
                                    var output = document.getElementById('event_logo');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    $('#event_logo').Jcrop({
                                        aspectRatio: 3 / 2,
                                        setSelect: [ 0, 0, 320, 240 ],
                                        onSelect: setCoords,
                                        onChange: setCoords
                                    });
                                };
                                function setCoords(c) {
                                    var img = document.getElementById("event_logo");
                                    var ow = img.width;
                                    jQuery('#x1').val(c.x);
                                    jQuery('#y1').val(c.y);
                                    jQuery('#x2').val(c.x2);
                                    jQuery('#y2').val(c.y2);
                                    jQuery('#w').val($(".new_logo").width());
                                    jQuery('#h').val($(".new_logo").height());
                                    jQuery('#ow').val(ow);
                                };
                            </script>
                            <input type="hidden" id="x1" name="crop_x1" value="">
                            <input type="hidden" id="y1" name="crop_y1" value="">
                            <input type="hidden" id="x2" name="crop_x2" value="">
                            <input type="hidden" id="y2" name="crop_y2" value="">
                            <input type="hidden" id="w" name="crop_w" value="">
                            <input type="hidden" id="h" name="crop_h" value="">
                            <input type="hidden" id="ow" name="crop_ow" value="">
                            {{-- end Input LOGO image --}}

                            {{-- Input TICKET_TEMPLATE image --}}
                            <div class="d-flex justify-content-center w-100">
                                <div class="col-6 mb-4 d-flex justify-content-center">
                                    <img class="img-fluid new_logo_tt" src="/storage/templates/ticket_template.svg" alt="Ticket template" id="ticket_temp_logo">
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label for='ticket_temp' class="form-label">Шаблон билета</label>
                                <input name="ticket_temp" class="form-control" type="file" id="ticket_temp" aria-describedby="ticket_tempHelp" onchange="loadTtempFile(event)" accept="image/png, image/jpeg">
                                <div id="ticket_tempHelp" class="form-text">Шаблон билета в формате PNG или JPG. В пропорции 210х297.</div>
                            </div>

                            <script>
                                var loadTtempFile = function(event) {
                                    var toutput = document.getElementById('ticket_temp_logo');
                                    toutput.src = URL.createObjectURL(event.target.files[0]);
                                    $('#ticket_temp_logo').Jcrop({
                                        aspectRatio: 210 / 297,
                                        setSelect: [ 0, 0, 210, 297 ],
                                        onSelect: setCoordsTt,
                                        onChange: setCoordsTt
                                    });
                                };
                                function setCoordsTt(c) {
                                    var img = document.getElementById("ticket_temp_logo");
                                    var ow = img.width;
                                    jQuery('#x1tt').val(c.x);
                                    jQuery('#y1tt').val(c.y);
                                    jQuery('#x2tt').val(c.x2);
                                    jQuery('#y2tt').val(c.y2);
                                    jQuery('#wtt').val($(".new_logo_tt").width());
                                    jQuery('#htt').val($(".new_logo_tt").height());
                                    jQuery('#owtt').val(ow);
                                };
                            </script>
                            <input type="hidden" id="x1tt" name="tt_crop_x1" value="">
                            <input type="hidden" id="y1tt" name="tt_crop_y1" value="">
                            <input type="hidden" id="x2tt" name="tt_crop_x2" value="">
                            <input type="hidden" id="y2tt" name="tt_crop_y2" value="">
                            <input type="hidden" id="wtt" name="tt_crop_w" value="">
                            <input type="hidden" id="htt" name="tt_crop_h" value="">
                            <input type="hidden" id="owtt" name="tt_crop_ow" value="">
                            {{-- end Input TICKET_TEMPLATE image --}}

                            <div class="col-12 mb-4">
                                <label for="price" class="form-label">Стоимость</label>
                                <div class="input-group">
                                    <span class="input-group-text">&#8372;</span>
                                    <input name="price" type="number" value="100" class="form-control text-end" id="price" required>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="template" class="form-label">Статус</label>
                                <select name="template" id="template" class="form-select" aria-label="Статус">
                                    <option value="0">Активная</option>
                                    <option value="1">Черновик</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col mb-4">
                                    <label for="dpickerstart" class="form-label">Начало</label>
                                    <input id="dpickerstart" name="start" type="text" class="form-control" id="start" required>
                                </div>
                                <div class="col mb-4">
                                    <label for="dpickerstop" class="form-label">Конец</label>
                                    <input id="dpickerstop" name="stop" type="text" class="form-control" id="stop" required>
                                </div>
                            </div>

                            <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
                            <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
                            <script>
                                $.datetimepicker.setLocale('ru');
                                jQuery('#dpickerstart').datetimepicker({
                                    dayOfWeekStart: 1,
                                    format:'Y-m-d H:i',
                                    lang: 'ru'
                                });
                                jQuery('#dpickerstop').datetimepicker({
                                    dayOfWeekStart: 1,
                                    format:'Y-m-d H:i',
                                    lang: 'ru'
                                });
                            </script>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
