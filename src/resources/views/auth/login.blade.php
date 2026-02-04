<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
        <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">
    </header>

    <div class="container">
        <h1>ログイン</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ログイン</button>
        </form>

        <p><a href="{{ route('register') }}">会員登録はこちら</a></p>
    </div>
</body>
</html>
