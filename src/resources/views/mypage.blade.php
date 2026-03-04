<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>商品一覧</title>
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
</head>

<body>

<header>
<div class="header-inner">

<img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">

<form action="{{ route('mypage') }}" method="GET">
<input
type="text"
name="keyword"
placeholder="なにをお探しですか？"
value="{{ request('keyword') }}"
>
</form>

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


<!-- タブ -->
<div class="tab">

<button class="tab-button active" onclick="showTab('recommend')">
おすすめ
</button>

<button class="tab-button" onclick="showTab('mylist')">
マイリスト
</button>

</div>


<!-- ========================= -->
<!-- おすすめ -->
<!-- ========================= -->

<div id="recommend" class="tab-content active">

<div class="product-list">

@forelse ($products as $product)

<a href="{{ route('product.show', $product->id) }}" class="product-link">

<div class="product-item">

<div class="product-image">

@if($product->purchase)
<div class="sold-badge">SOLD</div>
@endif

<img src="{{ $product->image }}" alt="{{ $product->name }}">

</div>

<div class="product-info">

<div class="product-title">
{{ $product->name }}
</div>

@if($product->brand)
<div class="product-brand">
{{ $product->brand }}
</div>
@endif

<div class="product-condition">
{{ $product->condition }}
</div>

<div class="product-price">
¥{{ number_format($product->price) }}
</div>

</div>

</div>

</a>

@empty

<p>商品がありません</p>

@endforelse

</div>

</div>



<!-- ========================= -->
<!-- マイリスト -->
<!-- ========================= -->

<div id="mylist" class="tab-content">

<div class="product-list">

@auth

@forelse (auth()->user()->likes as $like)

<a href="{{ route('product.show', $like->product->id) }}" class="product-link">

<div class="product-item">

<div class="product-image">

<img src="{{ $like->product->image }}">

</div>

<div class="product-title">

{{ $like->product->name }}

</div>

</div>

</a>

@empty

<p>いいねした商品がありません</p>

@endforelse

@else

<p>ログインするとマイリストが表示されます</p>

@endauth

</div>

</div>



<script>

function showTab(tab){

document.querySelectorAll('.tab-content').forEach(function(content){
content.classList.remove('active');
});

document.querySelectorAll('.tab-button').forEach(function(btn){
btn.classList.remove('active');
});

document.getElementById(tab).classList.add('active');

event.target.classList.add('active');

}

</script>

</body>
</html>


