<x-app head-title="Создать сообщение">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-message text-secondary"></i>&nbsp;Создать сообщение</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{  url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новое сообщение
                    </div>
                    <form action="/messages/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label">Название сообщения</label>
                                <input name="name" type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label">Текст сообщения</label>
                                <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
