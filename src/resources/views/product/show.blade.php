<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
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

<div class="detail-container">

    <!-- 左：商品画像 -->
    <div class="detail-image">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
    </div>

    <!-- 右：商品情報 -->
    <div class="detail-info">

        <h1>{{ $product->name }}</h1>

        @if($product->brand)
            <p class="brand">{{ $product->brand }}</p>
        @endif

        <p class="price">
            ¥{{ number_format($product->price) }} <span>（税込）</span>
        </p>
    <div class="icon-area">

    {{-- ❤️ いいね --}}
       <div class="icon-box">
        @auth
            <form action="{{ route('product.like', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="icon-button">
                    @if($product->likes->where('user_id', auth()->id())->count())
                        <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" alt="いいね" class="icon-img">
                    @else
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="いいね" class="icon-img">
                    @endif
                </button>
            </form>
        @else
            <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="いいね" class="icon-img">
        @endauth

        <p class="icon-count">{{ $product->likes->count() }}</p>
      </div>

    {{-- 💬 コメント --}}
       <div class="icon-box">
        <img src="{{ asset('images/comment.png') }}" alt="コメント" class="icon-img">
        <p class="icon-count">{{ $product->comments->count() }}</p>
       </div>

    </div>

        <a href="{{ route('product.purchase', $product->id) }}" class="buy-button">
            購入手続きへ
        </a>

        <h2>商品説明</h2>
        <p>{{ $product->description }}</p>

        <h2>商品の情報</h2>
        <p>商品の状態：{{ $product->condition }}</p>

        <h3>カテゴリー</h3>
        @foreach($product->categories as $category)
             <span class="category-tag">{{ $category->name }}</span>
        @endforeach

       <h2>コメント（{{ $product->comments->count() }}）</h2>

        @auth
           <form method="POST" action="{{ route('product.comment.store', $product->id) }}" class="comment-form">
                @csrf

                {{-- バリデーションエラー --}}
                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <textarea name="content" placeholder="コメントを入力してください">{{ old('content') }}</textarea>

                <button type="submit">コメントを送信する</button>
            </form>
        @else
           <p class="comment-login-guide">
              コメントするには <a href="{{ route('login') }}">ログイン</a> してください
            </p>
        @endauth

        @foreach($product->comments as $comment)
            <div class="comment-item">
                 <div class="comment-user">{{ $comment->user->name }}</div>
                 <div class="comment-content">{{ $comment->content }}</div>
            </div>
        @endforeach

    </div>
</div>

</body>
</html>