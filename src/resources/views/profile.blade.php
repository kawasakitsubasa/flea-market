<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="{{ asset('css/profiles.css') }}">
</head>
<body>
    <header>
        <div class="header-inner">
            <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">
            <input type="text" placeholder="なにをお探しですか？">
            <nav>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   ログアウト
                </a>
                <a href="{{ route('mypage') }}">マイページ</a>
                <button onclick="location.href='{{ route('sell') }}'">出品</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
    </header>

    <main>
        <div class="profile-top">
            <div class="avatar"></div>
            <h2>ユーザー名</h2>
            <button class="edit-button">プロフィールを編集</button>
        </div>

        <div class="tabs">
            <span class="active">出品した商品</span>
            <span>購入した商品</span>
        </div>

        <div class="product-list">
            @for ($i = 0; $i < 8; $i++)
            <div class="product-item">
                <div class="product-image">商品画像</div>
                <div class="product-name">商品名</div>
            </div>
            @endfor
        </div>
    </main>
</body>
</html>
