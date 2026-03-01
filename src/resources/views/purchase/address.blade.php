<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>住所の変更</title>
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
</head>
<body>

<header class="main-header">
    <div class="header-inner">

        <!-- ロゴ -->
        <img class="logo" src="{{ asset('images/coachtech-logo.png') }}">

        <!-- 検索 -->
        <input class="search-input" type="text" placeholder="なにをお探しですか？">

        <!-- ナビ -->
        <div class="nav-area">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

            <button class="logout-btn"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                ログアウト
            </button>

            <a href="{{ route('profile') }}" class="mypage-link">
                マイページ
            </a>

            <button class="sell-btn"
                onclick="location.href='{{ route('sell') }}'">
                出品
            </button>

        </div>
    </div>
</header>

<div class="address-container">
    <h1>住所の変更</h1>

    <form method="POST" action="{{ route('purchase.address.update') }}">
        @csrf
        @method('PUT')

        <!-- product_idを渡す（超重要） -->
        <input type="hidden" name="product_id" value="{{ $product_id }}">

        <label>郵便番号</label>
        <input type="text" name="zipcode" value="{{ auth()->user()->zipcode }}">

        <label>住所</label>
        <input type="text" name="address" value="{{ auth()->user()->address }}">

        <label>建物名</label>
        <input type="text" name="building" value="{{ auth()->user()->building }}">

        <button type="submit">更新する</button>
    </form>
</div>

</body>
</html>