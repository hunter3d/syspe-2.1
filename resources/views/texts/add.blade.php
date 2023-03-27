<x-app head-title="Создать текст">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-file-alt text-secondary"></i>&nbsp;Создать текст</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Создать новый текст
                    </div>
                    <form action="/tickets/add" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label">Краткое описание</label>
                                <input name="name" type="text" class="form-control" id="name" required>
                            </div>
                            <script src="/js/tinymce/tinymce.min.js"></script>
                            <div class="col-12 mb-4">
                                <label for="text_uk" class="form-label">Текст на украинском</label>
                                <textarea name="text_uk" class="form-control" id="text_uk" rows="10" required></textarea>
                            </div>
                            <script>
                                tinymce.init({
                                    selector: 'textarea#text_uk',
                                    menubar: "false",
                                    plugins: 'advlist link lists',
                                    toolbar: 'undo redo | styles | bold italic | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify | outdent indent',
                                    promotion: false
                                });
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>

