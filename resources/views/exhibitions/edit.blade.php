<x-app head-title="Редактировать выставку">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-copyright text-secondary"></i>&nbsp;Редактировать выставку</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ route('exhibitions') }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Редактировать выставку
                    </div>
                    <form action="/exhibitions/edit/{{$exhibition->id}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label">Название</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{$exhibition->name}}" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" class="form-control" id="description" rows="4">{{$exhibition->description}}</textarea>
                            </div>

                            <div class="d-flex justify-content-center w-100">
                                <div class="col-6 mb-4 d-flex justify-content-center">
                                    <img class="img-fluid new_logo" src="/{{$exhibition->logo_path.'/'.$exhibition->logo_name}}" alt="Exhibition logo" id="exhibition_logo">
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <label for="logo" class="form-label">Логотип</label>
                                <input name="logo" class="form-control" type="file" id="logo" aria-describedby="logoHelp" onchange="loadFile(event)" accept="image/png, image/jpeg">
                                <div id="logoHelp" class="form-text">Логотип выставки в формате PNG или JPG. В пропорции 1х1.</div>
                            </div>

                            <script type="text/javascript" src="{{asset('js/jquery.Jcrop.min.js')}}"></script>
                            <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}">
                            <script>
                                var loadFile = function(event) {
                                    var output = document.getElementById('exhibition_logo');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    $('#exhibition_logo').Jcrop({
                                        aspectRatio: 1 / 1,
                                        setSelect: [ 0, 0, 450, 450 ],
                                        onSelect: setCoords,
                                        onChange: setCoords
                                    });
                                };
                                function setCoords(c) {
                                    var img = document.getElementById("exhibition_logo");
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

                            <div class="col-12 mb-4">
                                <label for="template" class="form-label">Статус</label>
                                <select name="template" id="template" class="form-select" aria-label="Статус">
                                    <option value="0" {{$exhibition->template==0?'selected':''}}>Активная</option>
                                    <option value="1" {{$exhibition->template==1?'selected':''}}>Черновик</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
