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
                <a href="#">ログアウト</a>
                <a href="#">マイページ</a>
                <button>出品</button>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>プロフィール設定</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="icon-upload">
                <img src="{{ asset('images/default-user.png') }}" alt="" class="profile-icon">
                <label class="upload-button">
                    画像を選択する
                    <input type="file" name="avatar" style="display: none;">
                </label>
            </div>

            <input type="text" name="name" placeholder="ユーザー名" value="{{ old('name') }}">
            <input type="text" name="zipcode" placeholder="郵便番号" value="{{ old('zipcode') }}">
            <input type="text" name="address" placeholder="住所" value="{{ old('address') }}">
            <input type="text" name="building" placeholder="建物名" value="{{ old('building') }}">

            <button type="submit">更新する</button>
        </form>
    </div>
</body>
</html>
