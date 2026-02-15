<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品の出品</title>
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
</head>
<body>
<header>
    <div class="header-inner">
        <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">
        <input type="text" placeholder="なにをお探しですか？">
        <nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

            <button onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                ログアウト
            </button>

            <a href="{{ route('profile') }}">マイページ</a>

            <button onclick="location.href='{{ route('sell') }}'">出品</button>
        </nav>
    </div>
</header>

<main>
    <h1>商品の出品</h1>

    <form method="POST" action="{{ route('sell.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 商品画像 -->
        <section class="image-upload">
            <p>商品画像</p>
            <div class="upload-box">
                <label>
                    <input type="file" name="image" style="display: none;">
                    <span>画像を選択する</span>
                </label>
            </div>
        </section>

        <!-- 商品詳細 -->
        <section class="product-details">
            <h2>商品の詳細</h2>

            <!-- カテゴリー -->
            <div class="category">
                <p>カテゴリー</p>
                <div class="tags">
                    @php
                        $categories = [
                            'ファッション','家電','インテリア','レディース','メンズ',
                            'コスメ','本','ゲーム','スポーツ','キッチン',
                            'ハンドメイド','アクセサリー','おもちゃ','ベビー・キッズ'
                        ];
                    @endphp

                    @foreach($categories as $category)
                        <label class="tag">
                            <input type="checkbox" name="categories[]" value="{{ $category }}" hidden>
                            <span>{{ $category }}</span>
                        </label>

                    @endforeach
                </div>
            </div>

            <!-- 状態 -->
            <div class="condition">
                <p>商品の状態</p>
                <select name="condition">
                    <option disabled selected>選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
            </div>

            <!-- 商品情報 -->
            <div class="info">
                <p>商品名と説明</p>
                <input type="text" name="name" placeholder="商品名">
                <input type="text" name="brand" placeholder="ブランド名">
                <textarea name="description" placeholder="商品の説明"></textarea>
                <input type="number" name="price" placeholder="販売価格">
            </div>
        </section>

        <button type="submit" class="submit-button">出品する</button>
    </form>
</main>

</body>
</html>

