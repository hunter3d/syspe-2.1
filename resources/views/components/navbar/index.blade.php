<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow">
    <div class="container-fluid justify-content-between">
        <x-navbar.toggler/>

        <a class="d-flex align-items-center justify-content-center mb-2" href="/">
            <img src="/img/pe_white.svg" height="28" width="auto" alt="logo">
        </a>

        <ul class="nav justify-content-end align-items-center">
            <li class="nav-item px-2 justify-content-center align-items-center">
                <x-navbar.searchbtn/>
            </li>
            <li class="nav-item dropdown px-2 justify-content-center align-items-center">
                <x-navbar.user/>
            </li>
        </ul>

    </div>
</nav>
