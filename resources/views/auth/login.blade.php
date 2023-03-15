<x-guest head-title="Вход в систему">
    <form method="POST" action="/auth/login">
        @csrf
        <img class="mb-4" src="{{ asset('img/pe_optimised.svg') }}" alt="" width="auto" height="72">
        <h1 class="h3 mb-3 fw-normal">Вход в систему</h1>
        <div class="text-start">
            <div class="mb-3">
                <label class="form-label" for="floatingInput">Email</label>
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label class="form-label" for="floatingPassword">Пароль</label>
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            </div>
        </div>
{{--        <div class="checkbox mb-3">--}}
{{--            <label>--}}
{{--                <input type="checkbox" value="remember-me"> Запомнить меня--}}
{{--            </label>--}}
{{--        </div>--}}
        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Войти</button>
        <p class="mt-5 mb-3 text-muted"><small>&copy; PremierExpo System {{ ( date('Y',time()) == 2022 ? date('Y',time()) : '2022-'.date('Y',time()) ) }}</small></p>
    </form>
</x-guest>
