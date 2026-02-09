<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイリスト</title>
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
</head>
<body>
    <header>
        <div class="header-inner">
            <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">
            <input type="text" placeholder="なにをお探しですか？">
            <nav>
                <!-- ✅ フォームを先に書いておく -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- ✅ ボタン型にするのが一番確実 -->
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </button>

                <a href="#">マイページ</a>
                <button onclick="location.href='{{ route('sell') }}'">出品</button>
            </nav>
        </div>
    </header>

    <div class="tab">
        <span>おすすめ</span>
        <span class="active">マイリスト</span>
    </div>

    <div class="product-list">
        @for ($i = 0; $i < 3; $i++)
        <div class="product-item">
            <div class="product-image">商品画像</div>
            <div class="product-name">商品名</div>
        </div>
        @endfor
    </div>
</body>
</html>


