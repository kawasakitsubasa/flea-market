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

        {{-- ✅ ログアウト後のステータスメッセージ --}}
        @if (session('status'))
            <div class="status-box">
                {{ session('status') }}
            </div>
        @endif

        {{-- 🔴 エラーメッセージ表示ブロック --}}
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- 🔹 入力値を保持するため old() を追加 --}}
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit">ログイン</button>
        </form>

        <p><a href="{{ route('register') }}">会員登録はこちら</a></p>
    </div>
</body>
</html>

