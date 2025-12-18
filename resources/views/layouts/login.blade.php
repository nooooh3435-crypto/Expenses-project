<!-- <!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <div class="form">
    <h2>تسجيل الدخول</h2>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" required placeholder="Email">

      <label for="pass">كلمة المرور</label>
      <input type="password" id="pass" name="password" required placeholder="Password">

      <input type="submit" id="sub" value="دخول">
    </form>
    <div class="switch">
      ليس لديك حساب؟ <a href="{{ route('register.form') }}">إنشاء حساب</a>
    </div>
  </div>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

  <div class="h">
    <h2>Login</h2>
  </div>
  <div class="form">

    <br>
    <br>
    <br>
    <br>
    <br>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <label for="email">E-Mail</label>
      <input type="email" id="email" name="email" required placeholder="email">
      @error('email')
      <small style="color:red">{{ $message }}</small>
       @enderror
      <br><br>

      <label for="pass">password</label>
      <input type="password" id="pass" name="password" required placeholder="#Af5433@">

      <br><br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <button type="submit" id="sub" name="submit" >Login</button>
      <br>
      <br>
      <br>
      <label>You dont have an acount?</label>
      <a href="{{ route('register') }}">Register</a>

  </div>
  </form>

  <style>
    :root {
      --primaryColor: #ff274b;
      --secondaryColor: #f7bcf7;
      --lightColor: #ffffff;
      --bgColor-1: #171a1c;
      --bgColor-2: #22282a;
      --padding: 8%
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      font-family: 'Josefin Sans', sans-serif;
      font-size: 16px;
      color: var(--lightColor);
    }

    .form {
      width: 100%;
      height: 100vh;
      background-color: var(--bgColor-1);
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    a{
      color: var(--lightColor);
    }
    .h {
      background-color: var(--bgColor-1);

    }

    #lname,
    #age,
    #email,
    #user,
    #pass,
    #confirm,
    #country,
    #sub,
    #button {
      margin-left: 23px;
      height: 50px;
      width: 300px;
      border: double;
      border-color: var(--primaryColor);
      border-radius: 50px;
    }

    #fname {
      margin-left: 55px;
      height: 50px;
      width: 300px;
      border: double;
      border-color: var(--primaryColor);
      border-radius: 50px;

    }

    #age {
      margin-left: 41px;

    }

    #email {
      margin-left: 54px;
    }

    #pass,
    #confirm {
      margin-left: 30px;
    }

    #country {
      margin-left: 52px;
    }

    .name {
      margin-left: 40%;
      width: 35%;
      height: 100vh;
      color: var(--lightColor);
      display: inline-block;

    }

    input,
    #country {
      border-radius: 6px;
      border: double;
      width: 35%;
      min-height: auto;
      max-height: auto vh;


    }

    input:hover,
    #country:hover,#sub:hover{
      background-color: var(--primaryColor);
      border-color: var(--lightColor);
      transform: scale(1.08);
      transition: 0.3s;


    }

    label {
      color: var(--primaryColor);
    }

    label:hover {
      color: var(--lightColor);


    }

    h2 {
      color: var(--primaryColor);
      font-size: 60px;
      /* border: double; */
      border-radius: 100px;
      border-color: var(--primaryColor);
      width: fit-content;
      background: var(--bgColor-1);
      display: flex;
      ;


    }

    h2:hover {
      color: var(--lightColor);
      transform: scale(1.01);
      transition: 0.3s;

    }

    input[type="radio"],
    input[type="checkbox"] {
      width: 8%;
    }

    #sub,
    #button {
      width: 100px;
      margin-left: 300px;
    }
  </style>

  </div>

</body>

</html>