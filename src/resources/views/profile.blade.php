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
            <button class="edit-button" onclick="location.href='{{ route('profile.edit') }}'">
                プロフィールを編集
            </button>
        </div>

        <div class="tabs">
           <button class="tab-button active" onclick="showTab('sell')">
              出品した商品
           </button>
           <button class="tab-button" onclick="showTab('buy')">
              購入した商品
            </button>
        </div>

        <!-- 出品商品 -->
        <div id="sell" class="tab-content active">
           <div class="product-list">
        @forelse ($products as $product)
            <div class="product-item">
                <div class="product-image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>
                <div class="product-name">{{ $product->name }}</div>
            </div>
        @empty
            <p>出品した商品がありません</p>
        @endforelse
            </div>
        </div>

<!-- 購入商品（今はダミー） -->
    <div id="buy" class="tab-content">
       <div class="product-list">
        <p>購入した商品はまだありません</p>
       </div>
    </div>
    </main>

    <script>
    function showTab(tab) {
    document.querySelectorAll('.tab-content').forEach(function(content) {
        content.classList.remove('active');
    });

    document.querySelectorAll('.tab-button').forEach(function(btn) {
        btn.classList.remove('active');
    });

    document.getElementById(tab).classList.add('active');

    event.target.classList.add('active');
    }
    </script>
</body>
</html>
