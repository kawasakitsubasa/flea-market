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
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                <a href="{{ route('mypage') }}">マイページ</a>
                <button onclick="location.href='{{ route('sell') }}'">出品</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
    </header>

    <main>
        <h1>商品の出品</h1>

        <form method="POST" action="{{ route('sell.store') }}">
            @csrf

            <section class="image-upload">
                <p>商品画像</p>
                <div class="upload-box">
                    <label>
                        <input type="file" style="display: none;">
                        <span>画像を選択する</span>
                    </label>
                </div>
            </section>

            <section class="product-details">
                <h2>商品の詳細</h2>
                <div class="category">
                    <p>カテゴリー</p>
                    <div class="tags">
                        <span class="tag">ファッション</span>
                        <span class="tag">家電</span>
                        <span class="tag">インテリア</span>
                        <span class="tag">レディース</span>
                        <span class="tag">メンズ</span>
                        <span class="tag">コスメ</span>
                        <span class="tag">本</span>
                        <span class="tag">ゲーム</span>
                        <span class="tag">スポーツ</span>
                        <span class="tag">キッチン</span>
                        <span class="tag">ハンドメイド</span>
                        <span class="tag">アクセサリー</span>
                        <span class="tag">おもちゃ</span>
                        <span class="tag">ベビー・キッズ</span>
                    </div>
                </div>

                <div class="condition">
                    <p>商品の状態</p>
                    <select>
                        <option disabled selected>選択してください</option>
                        <option>良好</option>
                        <option>目立った傷や汚れなし</option>
                        <option>やや傷や汚れあり</option>
                        <option>状態が悪い</option>
                    </select>
                </div>

                <div class="info">
                    <p>商品名と説明</p>
                    <input type="text" placeholder="商品名">
                    <input type="text" placeholder="ブランド名">
                    <textarea placeholder="商品の説明"></textarea>
                    <input type="text" placeholder="販売価格">
                </div>
            </section>

            <button type="submit" class="submit-button">出品する</button>
        </form>
    </main>

    <script>
        document.querySelectorAll('.tag').forEach(function(tag) {
            tag.addEventListener('click', function() {
                tag.classList.toggle('selected');
            });
        });
    </script>
</body>
</html>

