
@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card p-4 shadow-sm form-card">

                <h2 class="text-center mb-4 title">دخول</h2>
                <div class="text-center mb-4">
                    <img src="{{ asset('https://e7.pngegg.com/pngimages/695/67/png-clipart-bookkeeping-receipt-accounting-expense-golding-accountancy-self-assessment-text-logo.png')}}"class="auth-logo" alt="Logo">

                    <h2 class="welcome-title">تابع مصاريفك اول بأول لتعرف اين يذهب مالك مع موقع ادارة المصاريف</h2>

                    
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label" >البريد الإلكتروني</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required placeholder="ادخل بريدك الإلكتروني">
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pass" class="form-label">كلمةالمرور</label>
                        <input type="password" id="pass" name="password"
                               class="form-control" required placeholder="#Af5433@">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">دخول</button>

                    <div class="text-center">
                        <span>ليس لدي حساب؟</span>
                        <a href="{{ route('register') }}" class="text-link">سجل من هنا</a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
<style>
       :root{
    --primaryColor: #ff274b;
    --secondaryColor: #f7bcf7;
    --lightColor: #ffffff;
    --bgColor-1: #171a1c;
    --bgColor-2: #22282a;
}

/* خلفية الصفحة */
body{
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    direction: rtl;
}

/* كرت الفورم */
.form-card{
    background-color: var(--bgColor-2);
    border-radius: 15px;
}

.form-label{
  color: var(--primaryColor);
}

/* العنوان */
.title{
    color: var(--primaryColor);
    font-size: 40px;
}

/* الحقول */
.form-control{
    border: 2px double var(--primaryColor);
    border-radius: 30px;
    height: 50px;
    padding-left: 20px;
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    width:  100%;
}

.form-control:focus{
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    border-color: var(--secondaryColor);
}

/* الأزرار */
.btn-primary{
    background-color: var(--primaryColor);
    border: none;
    border-radius: 30px;
    height: 50px;
}

.btn-primary:hover{
    background-color: var(--secondaryColor);
    color: var(--bgColor-1);
}

/* رابط التسجيل */
.text-link{
    color: var(--primaryColor);
    font-weight: bold;
}

.text-link:hover{
    color: var(--secondaryColor);
}

.auth-logo{
    width: 120px;
    height: 120px;
    object-fit: cover;
    margin-bottom: 15px;
    border-radius:80%;
    clip-path: path("M 0 40 Q 30 0 60 40 T 120 40 L 120 120 L 0 120 Z");
}

.auth-logo:hover{
    transform: translateX(-15px); 
}
.welcome-title{
    color: var(--primaryColor);
    font-size: 28px;
    margin-bottom: 10px;
}
#email,#pass{
    background-color: var(--lightColor);
    color: var(--bgColor-1);
}

  
</style>

@endsection


  