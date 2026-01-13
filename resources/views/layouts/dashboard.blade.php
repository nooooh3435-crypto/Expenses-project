


@extends('layouts.app')

@section('content')


<style>
  :root{
    --primaryColor: #ff274b;
    --secondaryColor: #f7bcf7;
    --lightColor: #ffffff;
    --bgColor-1: #171a1c;
    --bgColor-2: #22282a;
}

body{
    background-color: var(--bgColor-1);
    color: var(--lightColor);
    direction: rtl;
}

.title{
    color: var(--primaryColor);
    font-size: 40px;
}

.logout-link{
    color: var(--primaryColor);
    font-weight: bold;
}

.card-box{
    background: var(--bgColor-2);
    border-radius: 15px;
}

.section-title{
    color: var(--primaryColor);
}

.form-control{
    border: 2px double var(--primaryColor);
    border-radius: 30px;
    height: 45px;
    background-color: var(--lightColor);
    color: var(--primaryColor);
}

.btn-primary{
    background-color: var(--primaryColor);
    border-radius: 30px;
    border: none;
}

.btn-primary:hover{
    background-color: var(--secondaryColor);
    color: var(--bgColor-1);
}

.expense-item{
    background: var(--bgColor-1);
    border-radius: 10px;
}

.edit-btn, .delete-btn{
    background: #fff;
    color: #000;
    padding: 7px 12px;
    border-radius: 5px;
    cursor: pointer;
}

.edit-btn:hover, .delete-btn:hover{
    background: var(--primaryColor);
    color: #fff;
}

.modal{
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
}

.modal-box{
    background: var(--bgColor-2);
    border-radius: 15px;
    width: 90%;
    max-width: 400px;
}

</style>
<script>
function openModal(btn) {
    document.getElementById("modal").style.display = "flex";

    document.getElementById("edit-id").value = btn.dataset.id;
    document.getElementById("edit-date").value = btn.dataset.date;
    document.getElementById("edit-description").value = btn.dataset.description;
    document.getElementById("edit-amount").value = btn.dataset.amount;

    const form = document.getElementById("edit-form");
    const updateUrlTemplate = "{{ route('expenses.update', ':id') }}";
    form.action = updateUrlTemplate.replace(':id', btn.dataset.id);
}
function closeModal() {
    document.getElementById("modal").style.display = "none";
}
</script>


<div class="container py-4">

    <!-- الترحيب -->
    <div class="mb-4 text-center">
        <h2 class="title">مرحباً {{ $user->name }}</h2>
        <div class="text-center mb-3">
            <a href="{{ route('profile.show') }}" class="btn btn-secondary" style="border-radius:30px; color:#ff274b; text-decoration:none;">
                الملف الشخصي
            </a>
       </div>
       <br>
       <br>
       
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-link">
           تسجيل الخروج
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none; text-decoration:none;">
            @csrf
        </form>
        
    </div>

  
    <br>

    <div class="row">

        <!-- إضافة مصروف -->
        <div class="col-12 mb-4">
            <div class="card-box p-4">
                <h3 class="section-title text-center mb-3">إضافة مصروف</h3>

                <form method="POST" action="{{ route('expenses.store') }}" class="row g-3 justify-content-center">
                    @csrf

                    <div  class="col-12 col-md-3">
                        <input type="number" step="0.01" name="amount" class="form-control"
                               placeholder="المبلغ" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <input type="text" name="description" class="form-control"
                               placeholder="الوصف">
                    </div>

                    <div  class="col-12 col-md-3">
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div  class="col-12 col-md-2">
                        <button  type="submit" class="btn btn-primary w-100">إضافة</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- قائمة المصاريف -->
        <div class="col-12 col-lg-4">
            <div class="card-box p-4">
                <h3 class="section-title mb-3">قائمة المصاريف</h3>

                @if(session('success'))
                    <div class="alert-success mb-3">{{ session('success') }}</div>
                @endif

                @foreach($expenses as $exp)
                    <div class="expense-item mb-3 p-3">
                        <strong class="date">{{ \Carbon\Carbon::parse($exp->date)->format('d-m-Y') }}</strong> — {{ $exp->amount }} SR
                        <br>
                        <small>{{ $exp->description }}</small>

                        <div class="mt-3">
                            <button class="edit-btn"
                                data-id="{{ $exp->id }}"
                                data-date="{{ \Carbon\Carbon::parse($exp->date)->format('Y-m-d') }}"
                                data-description="{{ $exp->description }}"
                                data-amount="{{ $exp->amount }}"
                                onclick="openModal(this)">
                                تعديل
                            </button>



                            <form action="{{ route('expenses.delete', $exp->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- المصاريف اليومية -->
            <div class="col-12 col-lg-4 mt-4">
                <div class="card-box p-4">
                    <h3 class="section-title mb-3">المصاريف اليومية</h3>

                    @forelse($dailyExpenses as $day)
                        <div class="expense-item mb-2 p-2">
                            {{ \Carbon\Carbon::parse($day->day)->format('Y-m-d') }}
                            <br>
                            <strong>{{ number_format($day->total, 2) }} SR</strong>
                        </div>
                    @empty
                        <p>لا توجد بيانات</p>
                    @endforelse
                </div>
            </div>


            <!-- المصاريف الشهرية -->
            <div class="col-12 col-lg-4 mt-4">
                <div class="card-box p-4">
                    <h3 class="section-title mb-3">المصاريف الشهرية</h3>

                    @forelse($monthlyExpenses as $month)
                        <div class="expense-item mb-2 p-2">
                            {{ $month->year }} - {{ $month->month }}
                            <br>
                            <strong>{{ number_format($month->total, 2) }} SR</strong>
                        </div>
                    @empty
                        <p>لا توجد بيانات</p>
                    @endforelse
                </div>
            </div>



        </div>

    </div>

</div>

<!-- المودال -->
<div id="modal" class="modal">
    <div class="modal-box p-4">
        <h3 class="section-title mb-3">تعديل المصروف</h3>

        <form id="edit-form" method="POST" action="">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-id" name="id">

            <input type="date" id="edit-date" name="date" class="form-control mb-2">
            <input type="text" id="edit-description" name="description" class="form-control mb-2">
            <input type="number" step="0.01" id="edit-amount" name="amount" class="form-control mb-3">

            <button type="submit" class="btn btn-primary w-100 mb-2">حفظ</button>
            <button type="button" class="btn btn-secondary w-100"  onclick="closeModal()">إلغاء</button>
        </form>
    </div>
</div>

@endsection


