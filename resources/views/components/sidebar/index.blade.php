<aside class="bd-sidebar">
    <nav class="collapse bd-links" id="navbarAside" aria-label="Docs navigation">
        <ul class="list-unstyled mb-0 py-3 pt-md-1">
            <li>
                <a href="/" class="d-inline-flex align-items-center rounded">
                    <i class="fal fa-home fa-fw text-primary"></i>&nbsp;Начало
                </a>
            </li>
            @can('exhibitions')
                <li>
                    <a href="/exhibitions/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-copyright fa-fw text-primary"></i>&nbsp;Выставки
                    </a>
                </li>
            @endcan

            @can('events')
                <li>
                    <a href="/events/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-calendar-check fa-fw text-primary"></i>&nbsp;Мероприятия
                    </a>
                </li>
            @endcan

            @can('answers')
                <li>
                    <a href="/answers/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-question-square fa-fw text-primary"></i>&nbsp;Анкеты
                    </a>
                </li>
            @endcan

            @can('visitors')
                <li>
                    <a href="/visitors/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-users fa-fw text-primary"></i>&nbsp;Посетители
                    </a>
                </li>
            @endcan

            @can('cards')
                <li>
                    <a href="/cards/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-address-card fa-fw text-primary"></i>&nbsp;Карточки
                    </a>
                </li>
            @endcan

            @can('topics')
                <li>
                    <a href="/topics/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-briefcase fa-fw text-primary"></i>&nbsp;Специализации
                    </a>
                </li>
            @endcan

            @can('questionnaires')
                <li>
                    <a href="/questionnaires/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-check-square fa-fw text-primary"></i>&nbsp;Опросники
                    </a>
                </li>
            @endcan

            @can('promocodes')
                <li>
                    <a href="/promocodes/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-brackets fa-fw text-primary"></i>&nbsp;Промокоды
                    </a>
                </li>
            @endcan

            @can('orders')
                <li>
                    <a href="/orders/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-shopping-cart fa-fw text-primary"></i>&nbsp;Заказы
                    </a>
                </li>
            @endcan

            @can('tickets')
                <li>
                    <a href="/tickets/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-ticket fa-fw text-primary"></i>&nbsp;Билеты
                    </a>
                </li>
            @endcan

            @can('scaner')
                <li>
                    <a href="/scaner/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-barcode fa-fw text-primary"></i>&nbsp;Сканер
                    </a>
                </li>
            @endcan

            @can('reports')
                <li class="mb-1">
                    <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#report-collapse" aria-expanded="false">
                        <i class="fal fa-folders fa-fw text-primary"></i>&nbsp;Отчеты
                    </button>
                    <div class="collapse" id="report-collapse">
                        <ul class="list-unstyled fw-normal pb-1 small">
                            @can('reports')
                                <li>
                                    <a href="/reports/notickets" class="d-inline-flex align-items-center rounded">
                                        <i class="fal fa-fw fa-file-chart-line"></i>&nbsp;<span>Без заказов билетов</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            @can('texts')
                <li>
                    <a href="/texts/index" class="d-inline-flex align-items-center rounded">
                        <i class="fal fa-file-alt fa-fw text-primary"></i>&nbsp;Тексты
                    </a>
                </li>
            @endcan

            @can('config')
            <li class="mb-1">
                <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#admin-collapse" aria-expanded="false">
                    <i class="fal fa-cog fa-fw text-primary"></i>&nbsp;Параметры
                </button>
                <div class="collapse" id="admin-collapse">
                    <ul class="list-unstyled fw-normal pb-1 small">
                        @can('staff')<li><a href="/config/staff" class="d-inline-flex align-items-center rounded"><i class="fal fa-fw fa-users"></i>&nbsp;<span>Персонал</span></a></li>@endcan
                        @can('roles')<li><a href="/config/roles" class="d-inline-flex align-items-center rounded"><i class="fal fa-fw fa-shield-check"></i>&nbsp;<span>Роли</span></a></li>@endcan
                        @can('logs')<li><a href="/config/logs" class="d-inline-flex align-items-center rounded"><i class="fal fa-fw fa-file-alt"></i>&nbsp;<span>Логи</span></a></li>@endcan
                    </ul>
                </div>
            </li>
            @endcan
            <li class="my-3 mx-4 border-top"></li>
            <li>
                <a href="/auth/logout" class="d-inline-flex align-items-center rounded">
                    <i class="fal fa-sign-out fa-fw text-primary"></i>&nbsp;Выйти
                </a>
            </li>
        </ul>
    </nav>
</aside>
