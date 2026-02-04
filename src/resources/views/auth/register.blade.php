<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header>
        <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">
    </header>

    <div class="container">
        <h1>会員登録</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            @if ($errors->any())
              <div style="color: red; text-align: left;">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <input type="text" name="name" placeholder="ユーザー名" required>
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <input type="password" name="password_confirmation" placeholder="確認用パスワード" required>
            <button type="submit">登録する</button>
        </form>

        <p><a href="{{ route('login') }}">ログインはこちら</a></p>
    </div>
</body>
</html>

