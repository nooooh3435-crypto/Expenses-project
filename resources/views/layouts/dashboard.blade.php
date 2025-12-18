<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>
<style>
  body { background-color: #171a1c; color: #fff; font-family: Arial; padding: 20px; direction: rtl; }
  h2, h3 { color: #ff274b; }
  .box { background: #22282a; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
  .expense-item { background: #333; padding: 10px; margin: 5px 0; border-radius: 5px; }
  select { padding: 8px; border-radius: 5px; margin-bottom: 10px; }
  .add-expense-box { background: #22282a; padding: 20px; border-radius: 10px; margin-bottom: 20px; text-align: center; }
  .add-expense-box form { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; }
  input, button { padding: 10px; border: none; border-radius: 5px; }
  input { background: #fff; color: #000; }
  button { background: #fff; color: #000; font-weight: bold; cursor: pointer; transition: 0.3s; }
  button:hover { background: #ff274b; color: #fff; transform: scale(1.05); }
</style>
<script>
  const allExpenses = @json($expenses);

  function showDayExpenses(day) {
    const container = document.getElementById('day-expenses');
    container.innerHTML = '';
    const filtered = allExpenses.filter(e => e.date.startsWith(day));
    let total = 0;
    filtered.forEach(e => {
      total += parseFloat(e.amount);
      container.innerHTML += `<div class="expense-item">
        <strong style="color:#ff274b;">${e.date}</strong> ${e.amount} SR<br><small>${e.description}</small>
      </div>`;
    });
    if(filtered.length) container.innerHTML += `<div class="expense-item"><strong>المجموع:</strong> ${total} SR</div>`;
  }

  function showWeekExpenses(week) {
    const container = document.getElementById('week-expenses');
    container.innerHTML = '';
    const filtered = allExpenses.filter(e => getYearWeek(e.date) == week);
    let total = 0;
    filtered.forEach(e => {
      total += parseFloat(e.amount);
      container.innerHTML += `<div class="expense-item">
        <strong style="color:#ff274b;">${e.date}</strong> ${e.amount} SR<br><small>${e.description}</small>
      </div>`;
    });
    if(filtered.length) container.innerHTML += `<div class="expense-item"><strong>المجموع:</strong> ${total} SR</div>`;
  }

  function showMonthExpenses(monthKey) {
    const container = document.getElementById('month-expenses');
    container.innerHTML = '';
    const [year, month] = monthKey.split('-');
    const filtered = allExpenses.filter(e => {
      const d = new Date(e.date);
      return d.getFullYear() == year && (d.getMonth() + 1) == month;
    });
    let total = 0;
    filtered.forEach(e => {
      total += parseFloat(e.amount);
      container.innerHTML += `<div class="expense-item">
        <strong style="color:#ff274b;">${e.date}</strong> ${e.amount} SR<br><small>${e.description}</small>
      </div>`;
    });
    if(filtered.length) container.innerHTML += `<div class="expense-item"><strong>المجموع:</strong> ${total} SR</div>`;
  }

  function getYearWeek(dateStr) {
    const d = new Date(dateStr);
    const oneJan = new Date(d.getFullYear(),0,1);
    const numberOfDays = Math.floor((d - oneJan) / (24 * 60 * 60 * 1000));
    return d.getFullYear().toString() + 
           (Math.ceil((d.getDay() + 1 + numberOfDays) / 7)).toString().padStart(2,'0');
  }
</script>
</head>
<body>

<h2>مرحبا {{$user->name}}</h2>
<a style="color: #ff274b; text-decoration:none; border:double; border-radius:20px; border-color:#fff" href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
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

<!-- قائمة المصاريف الفردية -->
<div class="box">
  <h3>قائمة المصاريف</h3>
  @foreach($expenses as $exp)
    <div class="expense-item">
      <strong style="color:#ff274b;">{{$exp->date}}</strong> {{$exp->amount}} SR<br>
      <small>{{ $exp->description }}</small>
    </div>
  @endforeach
</div>

<!-- قائمة المصاريف اليومية -->
<div class="box">
  <h3>المصاريف اليومية</h3>
  <select onchange="showDayExpenses(this.value)">
    <option value="">اختر اليوم</option>
    @foreach($dailyExpenses as $day)
      <option value="{{ $day->day }}">
        {{ $day->day_name }} - {{ $day->day }} ({{ $day->total }} SR)
      </option>
    @endforeach
  </select>
  <div id="day-expenses"></div>
</div>

<!-- قائمة المصاريف الأسبوعية -->
<div class="box">
  <h3>المصاريف الأسبوعية</h3>
  <select onchange="showWeekExpenses(this.value)">
    <option value="">اختر الأسبوع</option>
    @foreach($weeklyExpenses as $week)
      <option value="{{ $week->week }}">
        الأسبوع {{ $week->week }} ({{ $week->start_date }} → {{ $week->end_date }}) مجموع: {{ $week->total }} SR
      </option>
    @endforeach
  </select>
  <div id="week-expenses"></div>
</div>

<!-- قائمة المصاريف الشهرية -->
<div class="box">
  <h3>المصاريف الشهرية</h3>
  <select onchange="showMonthExpenses(this.value)">
    <option value="">اختر الشهر</option>
    @foreach($monthlyExpenses as $month)
      <option value="{{ $month->year }}-{{ $month->month }}">
        {{ $month->year }}-{{ $month->month }} ({{ $month->total }} SR)
      </option>
    @endforeach
  </select>
  <div id="month-expenses"></div>
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