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
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </button>

                <a href="{{ route('profile') }}">マイページ</a>
                <button onclick="location.href='{{ route('sell') }}'">出品</button>
            </nav>
        </div>
    </header>

    <div class="tab">
        <span>おすすめ</span>
        <span class="active">マイリスト</span>
    </div>

    <div class="product-list">
    @forelse ($products as $product)
        <div class="product-item">
            <div class="product-image">
                {{ $product->name }}
            </div>
            <div class="product-name">
                ¥{{ number_format($product->price) }}
            </div>
        </div>
    @empty
        <p>まだ出品した商品がありません</p>
    @endforelse
</div>

</body>
</html>


