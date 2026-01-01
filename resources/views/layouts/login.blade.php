
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

@endsection

  