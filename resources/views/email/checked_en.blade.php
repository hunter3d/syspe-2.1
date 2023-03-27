<!DOCTYPE html>
<html>
<head>
    <title>my.pe.com.ua</title>
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
            <p class="title">Registration completed on MyPE</p>
            <p>You have successfully registered your account.</p>
            <p>To log into your account, use the following login and password:</p>
            <p><b>login: {{ $data['email'] }}</b></p>
            <p><b>password: {{ $data['password'] }}</b></p>
            <a class="btn" href="https://my.pe.com.ua/login">Enter</a>
            <p>Thank you!</p>
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

