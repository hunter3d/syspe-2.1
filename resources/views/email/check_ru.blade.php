<!DOCTYPE html>
<html>
<head>
    <title>MyPE</title>
</head>
<body>
<div>
    <div class="wrapper">
        <div class="logo">
            <a href="https://pe.com.ua" alt="PE logo">
                <img src="{{ $message->embed(public_path() . '/img/pe.jpg') }}" />
            </a>
        </div>

        <div class="body">
            <p class="title">Подтверждение регистрации на MyPE</p>
            <p>Для подтверждения регистрации, перейдите по ссылке ниже.</p>
            <p>
                <a href="https://my.pe.com.ua/verify/{{ $data['id'] }}/{{ $data['code'] }}">
                    https://my.pe.com.ua/verify/{{ $data['id'] }}/{{ $data['code'] }}
                </a>
            </p>
            <p>Если созданный аккаунт не будет подтвержден в течении 30 минут, вся введенная вами информация будет удалена.</p>
            <p>Спасибо!</p>
        </div>

        <div class="footer">
            <hr/>
            <div class="copyright">
                <p>&copy; <a href="https://my.pe.com.ua">MyPE PremierExpo</a></p>
                <p>2022-2023</p>
            </div>
        </div>
    </div>
</div>


<style>
    body {
        background-color: #e3f2fd;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: .875rem;
        font-weight: 500;
        line-height: 1.375rem;
        letter-spacing: .00714em;
    }
    a {
        color: #00518c;
    }
    .wrapper {
        margin: 1em auto !important;
        padding: 1em;
        background: #ffffff;
        max-width: 600px;
        height: 100%;
    }
    .logo {
        width: 150px;
        margin: 0 auto 1em;
    }
    .logo image {
        width: 100%;
        height: auto;
    }
    .title {
        color: #00518c;
        margin: 1em 0;
        font-size: 24px;
    }
    .copyright {
        margin: 1em;
        text-align: center;
        font-size: 12px;
        color: grey;
    }
    .btn {
        display: inline-block;
        padding: 8px 12px;
        margin: 1em;
        background-color: #00518c;
        color: #ffffff;
        text-decoration: none;
        text-transform: uppercase;
        text-align: center;
    }
</style>
</body>
</html>