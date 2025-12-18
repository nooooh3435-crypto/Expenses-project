





<!-- <!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>الملف الشخصي</title>
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background-color: #171a1c;
      color: #fff;
      margin: 0;
      padding: 20px;
      direction: rtl;
    }
    .profile-box {
      background: #22282a;
      padding: 30px;
      border-radius: 12px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    h2 {
      color: #ff274b;
      text-align: center;
      margin-bottom: 20px;
    }
    .profile-img {
      display: block;
      margin: auto;
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
      border: 3px solid #ff274b;
    }
    .info {
      margin-top: 20px;
      font-size: 16px;
    }
    .info strong {
      color: #ff274b;
    }
    form {
      margin-top: 20px;
    }
    input, button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: none;
    }
    input {
      background: #fff;
      color: #000;
    }
    button {
      background: #ff274b;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #fff;
      color: #ff274b;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<div class="profile-box">
  <h2>الملف الشخصي</h2>

  
  @if($profile->image)
    <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Image" class="profile-img">
  @else
    <img src="{{ asset('images/default.png') }}" alt="Default Image" class="profile-img">
  @endif

  
  <div class="info">
    <p><strong>الاسم المستعار:</strong> {{ $profile->nick_name }}</p>
    <p><strong>الوظيفة:</strong> {{ $profile->occupation }}</p>
    <p><strong>الراتب:</strong> {{ $profile->salary }} ريال</p>
  </div>

  
  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nick_name" value="{{ $profile->nick_name }}" placeholder="الاسم المستعار">
    <input type="text" name="occupation" value="{{ $profile->occupation }}" placeholder="الوظيفة">
    <input type="number" name="salary" value="{{ $profile->salary }}" placeholder="الراتب">
    <input type="file" name="image">
    <button type="submit">تحديث البيانات</button>
  </form>
</div>

</body>
</html> -->







<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>الملف الشخصي</title>
  <style>
    body { font-family: Tahoma; background-color: #171a1c; color: #fff; padding: 20px; direction: rtl; }
    .profile-box { background: #22282a; padding: 30px; border-radius: 12px; max-width: 700px; margin: auto; }
    h2 { color: #ff274b; text-align: center; margin-bottom: 20px; }
    .profile-img { display: block; margin: auto; border-radius: 50%; width: 120px; height: 120px; object-fit: cover; border: 3px solid #ff274b; }
    .info { margin-top: 20px; font-size: 16px; }
    .info strong { color: #ff274b; }
    input, button { width: 100%; padding: 10px; margin: 8px 0; border-radius: 6px; border: none; }
    input { background: #fff; color: #000; }
    button { background: #ff274b; color: #fff; font-weight: bold; cursor: pointer; transition: 0.3s; }
    button:hover { background: #fff; color: #ff274b; transform: scale(1.05); }
  </style>
</head>
<body>

<div class="profile-box">
  <h2>الملف الشخصي</h2>

  @if($profile->image)
    <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Image" class="profile-img">
  @else
    <img src="{{ asset('images/default.png') }}" alt="Default Image" class="profile