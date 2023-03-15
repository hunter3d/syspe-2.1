<div class="container-fluid p-0">
    <form action="/search" class="p-2 bg-light shadow collapse" id="searchBlock" method="POST">
        @csrf
        <div class="input-group">
            <select name="model" class="form-select" id="inputGroupSelect01" style="max-width: 140px;">
                <option value="cards">Карточки</option>
            </select>
            <input name="query" class="form-control" type="search" placeholder="Поиск" aria-label="Поиск"  aria-describedby="searchHelp">
            <button class="btn btn-primary" type="submit">Найти</button>
        </div>
        <div class="form-text" id="searchHelp">Для поиска укажите в каком разделе искать.</div>
    </form>
</div>
