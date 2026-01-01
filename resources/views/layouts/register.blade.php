
@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card p-4 shadow-sm form-card">

                <h2 class="text-center mb-4 title">انشاء حساب جديد</h2>
                <div class="text-center mb-4">
    <img src="{{ asset('https://e7.pngegg.com/pngimages/695/67/png-clipart-bookkeeping-receipt-accounting-expense-golding-accountancy-self-assessment-text-logo.png')}}"class="auth-logo" alt="Logo">

    <h2 class="welcome-title">مرحباً بك في موقع إدارة المصاريف</h2>

    <p class="welcome-text" style="color:#ff274b;">
        نحن نساعدك على تتبع مصاريفك اليومية وتنظيم ميزانيتك بسهولةوبوضوح
    </p>
</div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="fname" class="form-label">الاسم</label>
                        <input type="text" id="fname" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required placeholder="اكتب اسمك">
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required placeholder="ادخل بريدك الإلكتروني">
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">كلمة المرور</label>
                        <input type="password" id="pass" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required placeholder="#Af5433@">
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirm" class="form-label">تأكيد كلمةالمرور</label>
                        <input type="password" id="confirm" name="password_confirmation"
                               class="form-control" required placeholder="اكتب كلمة المرور مرة أخرى">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">إنشاء</button>

                    <a href="{{ route('login') }}" class="btn btn-secondary w-100">العودة</a>

                </form>

            </div>

        </div>
    </div>

</div>

@endsection

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

/* العنوان */
.title{
    color: var(--primaryColor);
    font-size: 40px;
}
#fname,#email,#pass,#confirm{
    background-color: var(--lightColor);
    color: var(--bgColor-1);
}
/* الحقول */
.form-control{
    border: 2px double var(--primaryColor);
    border-radius: 30px;
    height: 50px;
    padding-left: 20px;
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    width: 100%;
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

.btn-secondary{
    background-color: var(--bgColor-1);
    border: 2px solid var(--primaryColor);
    border-radius: 30px;
    height: 50px;
    color: var(--primaryColor);
}

.btn-secondary:hover{
    background-color: var(--primaryColor);
    color: var(--lightColor);
}

/* العناوين */
label{
    color: var(--primaryColor);
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

.welcome-text{
    color: var(--primarycolor);
    font-size: 16px;
    opacity: 0.8;
    line-height: 1.6;
    margin-bottom: 20px;
}
</style>

