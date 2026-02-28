<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入確認</title>
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <img src="{{ asset('images/coachtech-logo.png') }}">
        <input type="text" placeholder="なにをお探しですか？">
        <nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

            <button onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                ログアウト
            </button>

            <a href="{{ route('profile') }}">マイページ</a>

            <button onclick="location.href='{{ route('sell') }}'">
                出品
            </button>
        </nav>
    </div>
</header>

<div class="purchase-container">

    <!-- 左側 -->
    <div class="left-area">

        <div class="product-info">
            <div class="product-image">
                <img src="{{ $product->image }}">
            </div>

            <div>
                <h2>{{ $product->name }}</h2>
                <p class="price">¥{{ number_format($product->price) }}</p>
            </div>
        </div>

        <hr>

        <h3>支払い方法</h3>
        <select id="payment-select">
            <option value="">選択してください</option>
            <option value="コンビニ払い">コンビニ払い</option>
            <option value="クレジットカード">クレジットカード</option>
        </select>

        <hr>

        <h3>
            配送先
            <a href="{{ route('profile.edit') }}">変更する</a>
        </h3>

        <p>
            〒 {{ $user->zipcode ?? '未登録' }}
        </p>

        <p>
            {{ $user->address ?? '' }}
            {{ $user->building ?? '' }}
        </p>

    </div>

    <!-- 右側 -->
    <div class="right-area">

        <div class="summary-box">
            <div class="row">
                <span>商品代金</span>
                <span>¥{{ number_format($product->price) }}</span>
            </div>

            <div class="row">
                <span>支払い方法</span>
                <span id="payment-display">未選択</span>
            </div>
        </div>

        <form method="POST" action="{{ route('product.purchase.store', $product->id) }}">
            @csrf

            <input type="hidden" name="payment_method" id="hidden-payment">

            <button type="submit" class="purchase-button">
                購入する
            </button>
        </form>

    </div>

</div>

<script>
const select = document.getElementById('payment-select');
const display = document.getElementById('payment-display');
const hidden = document.getElementById('hidden-payment');

select.addEventListener('change', function() {
    display.textContent = this.value || '未選択';
    hidden.value = this.value;
});
</script>

</body>
</html>