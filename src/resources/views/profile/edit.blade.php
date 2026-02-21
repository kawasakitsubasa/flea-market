<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール設定</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <img src="{{ asset('images/coachtech-logo.png') }}" alt="COACHTECH Logo">

        <input type="text" placeholder="なにをお探しですか？">

        <nav>
            <!-- ログアウトはPOST -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

            <button type="button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </button>

            <!-- プロフィール画面へ -->
            <a href="{{ route('profile') }}">マイページ</a>

            <!-- 出品画面へ -->
            <button type="button"
                onclick="location.href='{{ route('sell') }}'">
                出品
            </button>
        </nav>
    </div>
</header>

<div class="container">
    <h1>プロフィール設定</h1>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="icon-upload">
            <img src="{{ asset('images/default-user.png') }}"
                 alt="プロフィール画像"
                 class="profile-icon">

            <label class="upload-button">
                画像を選択する
                <input type="file" name="avatar" style="display: none;">
            </label>
        </div>

        <input type="text"
               name="name"
               placeholder="ユーザー名"
               value="{{ old('name', auth()->user()->name ?? '') }}">

        <input type="text"
               name="zipcode"
               placeholder="郵便番号"
               value="{{ old('zipcode', auth()->user()->zipcode ?? '') }}">

        <input type="text"
               name="address"
               placeholder="住所"
               value="{{ old('address', auth()->user()->address ?? '') }}">

        <input type="text"
               name="building"
               placeholder="建物名"
               value="{{ old('building', auth()->user()->building ?? '') }}">

        <button type="submit" class="update-button">
            更新する
        </button>
    </form>
</div>

</body>
</html>
