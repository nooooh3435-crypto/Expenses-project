<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>
<style>
  body {
    background-color: #171a1c;
    color: #ffffff;
    font-family: Arial;
    padding: 20px;
    direction: rtl;
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* كل العناصر على اليمين */
  }

  h2, h3 { color: #ff274b; }

  /* صندوق عام */
  .box {
    background: #22282a;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    width: 300px; /* عرض ثابت للقوائم على اليمين */
  }

  /* صندوق إضافة مصروف في المنتصف */
  .add-expense-box {
    background: #22282a;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: center; /* محتوى في المنتصف */
    width: 100%; /* ياخذ العرض كامل */
  }

  .add-expense-box form {
    display: flex;
    flex-direction: row; /* الحقول بشكل عرضي */
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
  }

  input, button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin: 5px 0;
  }

  input {
    background: #ffffff;
    color: #000;
  }

  button {
    background: #ffffff;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background: #ff274b;
    color: #ffffff;
    transform: scale(1.05);
  }

  .expense-item {
    background: #22282a;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
  }

  .edit-btn, .delete-btn {
    background: #ffffff;
    color: #000;
    padding: 7px 12px;
    margin-right: 10px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
  }

  .edit-btn:hover, .delete-btn:hover {
    background: #ff274b;
    color: #ffffff;
    transform: scale(1.05);
  }

  /* المودال */
  .modal {
    position: fixed;
    top: 0; right: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
  }

  .modal .box {
    width: 400px;
  }
</style>
<script>
  function openModal(id, date, description, amount) {
    document.getElementById("modal").style.display = "flex";
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-date").value = date;
    document.getElementById("edit-description").value = description;
    document.getElementById("edit-amount").value = amount;

    const form = document.getElementById("edit-form");
    const updateUrlTemplate = "{{ route('expenses.update', ':id') }}";
    form.action = updateUrlTemplate.replace(':id', id);
  }
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
</script>
</head>
<body>

<h2> مرحبا {{$user->name}} </h2>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:#ff274b;">تسجيل الخروج</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

<hr>

<!-- إضافة مصروف في المنتصف -->
<div class="add-expense-box">
  <h3>إضافة مصروف</h3>
  <form method="POST" action="{{ route('expenses.store') }}">
    @csrf
    <input type="number" step="0.01" name="amount" placeholder="المبلغ" required>
    <input type="text" name="description" placeholder="الوصف">
    <input type="date" name="date" required>
    <button type="submit">إضافة</button>
  </form>
</div>

<!-- قائمة المصاريف على اليمين -->
<div class="box">
  <h3>قائمة المصاريف</h3>

  @if(session('success'))
    <div style="background:#28a745; color:#fff; padding:10px; border-radius:5px; margin-bottom:15px;">
        {{ session('success') }}
    </div>
  @endif
  
  @foreach($expenses as $exp)        
    <div class="expense-item">
      <strong style="color:#ff274b;">{{$exp->date}}</strong> {{$exp->amount}} SR
      <br><small>{{ $exp->description }}</small><br><br>
      <button class="edit-btn" onclick="openModal('{{ $exp->id }}','{{ $exp->date }}','{{ $exp->description }}','{{ $exp->amount }}')">تعديل</button>
      <form  action="{{ route('expenses.delete', $exp->id) }}" method="POST" style="display:inline">
         @csrf
         @method('DELETE')
        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete?')"> حذف</button>
      </form>
    </div>
  @endforeach
</div>

<!-- مودال مشترك -->
<div id="modal" class="modal">
  <div class="box">
    <h3>تعديل المصروف</h3>
    <form id="edit-form" method="POST" action="">
      @csrf
      @method('PUT')

      <input type="hidden" id="edit-id" name="id">
      <input type="date" id="edit-date" name="date">
      <input type="text" id="edit-description" name="description">
      <input type="number" step="0.01" id="edit-amount" name="amount">
      <button type="submit">حفظ</button>
      <button type="button" onclick="closeModal()">إلغاء</button>
    </form>
  </div>
</div>

</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
    body {
        background-color: #171a1c;
        color: #ffffff;
        font-family: Arial;
        padding: 20px;
    }

    h2, h3 {
        color: #ff274b;
    }

    .box {
        background: #22282a;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    input, button {
        padding: 10px;
        border: none;
        border-radius: 5px;
        margin: 5px 0;
    }

    input {
        background: #ffffff;
        color: #000;
        width: 100%;
    }

    button {
        background: #ffffff;
        color: #000;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #ff274b;
        color: #ffffff;
        transform: scale(1.05);
    }

    .expense-item {
        background: #22282a;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .edit-btn, .delete-btn {
        background: #ffffff;
        color: #000;
        padding: 7px 12px;
        margin-right: 10px;
        border-radius: 5px;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none;
    }

    .edit-btn:hover, .delete-btn:hover {
        background: #ff274b;
        color: #ffffff;
        transform: scale(1.05);
    }

 
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        padding-top: 100px;
    }

    .modal-content {
        background: #22282a;
        padding: 20px;
        margin: auto;
        width: 40%;
        border-radius: 10px;
    }
</style>

<script>
    function openModal(id, date, description, amount) {
        document.getElementById("modal").style.display = "block";
        document.getElementById("edit-id").value = id;
        document.getElementById("edit-date").value = date;
        document.getElementById("edit-description").value = description;
        document.getElementById("edit-amount").value = amount;
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }
</script>

</head>

<body>

<h2>Welcome, {{ $user->name }}</h2>
<a href="/logout" style="color:#ff274b;">Logout</a>

<hr>

<div class="box">
    <h3>Add Expense</h3>

    <form method="POST" action="/expenses">
        @csrf
        <input type="date" name="date" required>
        <input type="text" name="description" placeholder="Description">
        <input type="number" step="0.01" name="amount" placeholder="Amount" required>
        <button type="submit">Add Expense</button>
    </form>
</div>

<div class="box">
    <h3>Your Expenses</h3>

    @foreach($expenses as $exp)
    <div class="expense-item">
        <strong style="color:#ff274b;">{{ $exp->date }}</strong>  
        - {{ $exp->amount }} SR 
        <br>
        <small>{{ $exp->description }}</small>
        <br><br>

        <button class="edit-btn"
            onclick="openModal('{{ $exp->id }}', '{{ $exp->date }}', '{{ $exp->description }}', '{{ $exp->amount }}')">
            Edit
        </button>

        <a class="delete-btn" href="/expenses/{{ $exp->id }}/delete">
            Delete
        </a>
    </div>
    @endforeach
</div>



<div id="modal" class="modal">
    <div class="modal-content">
        <h3>Edit Expense</h3>
        <form method="POST" action="/expenses/update">
            @csrf
            <input type="hidden" id="edit-id" name="id">

            <input type="date" id="edit-date" name="date">
            <input type="text" id="edit-description" name="description">
            <input type="number" step="0.01" id="edit-amount" name="amount">

            <button type="submit">Save Changes</button>
            <button type="button" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

</body>
</html> -->