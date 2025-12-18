<!-- <!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إنشاء حساب جديد</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <div class="form">
    <h2>إنشاء حساب</h2>
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <label for="fname">الاسم</label>
      <input type="text" id="fname" name="name" required placeholder="الاسم الكامل">

      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" required placeholder="Email">

      <label for="pass">كلمة المرور</label>
      <input type="password" id="pass" name="password" required placeholder="Password">

      <label for="confirm">تأكيد كلمة المرور</label>
      <input type="password" id="confirm" name="password_confirmation" required placeholder="Repeat password">

      <input type="submit" id="sub" value="تسجيل">
    </form>
    <div class="switch">
      لديك حساب؟ <a href="{{ route('login.form') }}">تسجيل الدخول</a>
    </div>
  </div>
</body>
</html> -->


@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A New Acount</title>
    <link rel="stylesheet" href="login.css">
    
</head>
<body>
    
    
    <div class="form">
        <h2>Create An Acount</h2>
        <br>
        <br>
        <br>
        <br>
        <br>
       
        <form action="{{ route('register') }}" method="POST">
            @csrf

            
            <div class="name">
            <div class="fname">
                <label  for="fname" class="col-md-4 col-form-label text-md-end" > Name  </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"  required id="fname" name="name" placeholder="first name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>
           
            <label for="email"   class="col-md-4 col-form-label text-md-end">E-Mail</label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="email">
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <br><br>
            
            <label for="pass" class="col-md-4 col-form-label text-md-end">password</label>
            <input type="password" id="pass" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="#Af5433@">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <br><br>
            <label for="confirm" class="col-md-4 col-form-label text-md-end">  confirm....   </label>
            <input type="password" id="confirm" name="password_confirmation" autocomplete="new-password" class="form-control" required placeholder="write the password down again">
           
            <br><br>
           
            <br>
            
            <br><br>
            <button type="submit" id="button" class="btn btn-primary" name="submit" value="send">{{ __('register') }}</button>
            <br>
            <br>
            <label for="button"></label>
            <a href="{{ route('login') }}"><button type="button" id="button"value="back" name="button">Back</button></a>
            </div>
        </form>
        
        @endsection
        <style>
            :root{
    --primaryColor: #ff274b;
    --secondaryColor: #f7bcf7;
    --lightColor: #ffffff;
    --bgColor-1: #171a1c;
    --bgColor-2: #22282a;
    --padding: 8%
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
html{
    font-family: 'Josefin Sans', sans-serif;
    font-size: 16px;
    color: var(--lightColor);
}
.form{
    width: 100%;
    height: 100vh;
    background-color: var(--bgColor-1);
    display: flex;
    flex-direction: column;
}
#lname,#age,#email,#user,#pass,#confirm,#country,#sub,#button{
    margin-left: 23px;
    height:50px;
    width: 300px;
    border: double;
    border-color: var(--primaryColor);
    border-radius: 50px;
}
#fname{
    margin-left: 55px;
    height:50px;
    width: 300px;
    border: double;
    border-color: var(--primaryColor);
    border-radius: 50px;

}
#age{
    margin-left: 41px;

}

#email{
    margin-left: 54px;
}
#pass,#confirm{
    margin-left: 30px;
}
#country{
    margin-left: 52px;
}

.name{
    margin-left: 40%;
    width: 35%;
    height: 100vh;
    color: var(--lightColor);
    display:inline-block;

}
input,#country{
    border-radius: 6px;
    border: double;
    width: 35%;
    min-height: auto;
    max-height:auto vh;

    
}
input:hover,#country:hover,button:hover{
    background-color: var(--primaryColor);
    border-color: var(--lightColor);
    transform: scale(1.08);
    transition: 0.3s;


}
label{
    color: var(--primaryColor);
}
label:hover{
    color: var(--lightColor);


}

h2{
    color: var(--primaryColor);
    font-size: 60px;
    /* border:double; */
   border-radius: 100px;
   border-color: var(--primaryColor);
    width:fit-content;
    background: var(--bgColor-1);
    

}
h2:hover{
    color: var(--lightColor);
    transform: scale(1.01);
    transition: 0.3s;
    
}
input[type="radio"],input[type="checkbox"]{
    width: 8%;
}
#sub,#button{
    width: 100px;
    margin-left: 300px;
}

        </style>
        
    </div>
    
</body>
</html>
