<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
</head>
<body>
    <header>
        <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECHロゴ">
    </header>

    <div class="container">
        <h1>メール認証のお願い</h1>

        <p>登録されたメールアドレス宛に認証リンクを送信しました。<br>
        メールをご確認のうえ、リンクをクリックして登録を完了してください。</p>

        <p>メールが届いていない場合は、下のボタンから再送信できます。</p>

        @if (session('status') == 'verification-link-sent')
            <p class="message">新しい認証リンクを送信しました！</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">認証メールを再送する</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    </div>
</body>
</html>

