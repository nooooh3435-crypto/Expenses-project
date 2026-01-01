@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card p-4 shadow-sm form-card">

                <h2 class="text-center mb-4 title">الملف الشخصي</h2>

                <!-- الصورة -->
                @if($profile && $profile->Image)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $profile->Image) }}"
                             style="width:120px; height:120px; border-radius:50%; border:3px solid var(--primaryColor);">
                    </div>
                @endif


                <!-- اللقب -->
                <div class="mb-3">
                    <label class="form-label">اللقب</label>
                    <input type="text" class="form-control"
                           value="{{ $profile->Nick_Name ?? 'غير محدد' }}" >
                </div>

                <!-- الوظيفة -->
                <div class="mb-3">
                    <label class="form-label">الوظيفة</label>
                    <input type="text" class="form-control"
                           value="{{ $profile->Occupation ?? 'غير محدد' }}" >
                </div>

                <!-- الراتب -->
                <div class="mb-3">
                    <label class="form-label">الراتب</label>
                    <input type="text" class="form-control"
                           value="{{ $profile->Salary ?? 'غير محدد' }}" >
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-secondary w-100 mt-3">
                    رجوع للداشبورد
                </a>

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
}

/* صندوق البروفايل */
.form-card{
    background-color: var(--bgColor-2);
    border-radius: 15px;
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
}

.form-control:focus{
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    border-color: var(--secondaryColor);
}

/* زر الرجوع */
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

/* صورة البروفايل */
.profile-image{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid var(--primaryColor);
    object-fit: cover;
}
</style>