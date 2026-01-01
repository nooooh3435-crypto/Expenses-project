<?php


namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= auth()->user();
        $expenses = Expense::where('user_id', auth()->id())
        ->orderBy('date', 'desc')
        ->get();

    // تجميع يومي مع اسم اليوم + التاريخ
        $dailyExpenses = Expense::selectRaw('DAYNAME(date) as day_name, DATE(date) as day, SUM(amount) as total')
            ->groupBy('day_name', 'day')
            ->orderBy('day', 'desc')
            ->get();

        // تجميع أسبوعي مع نطاق التاريخ
        $weeklyExpenses = Expense::selectRaw('YEARWEEK(date, 1) as week, MIN(DATE(date)) as start_date, MAX(DATE(date)) as end_date, SUM(amount) as total')
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->get();

        // تجميع شهري
        $monthlyExpenses = Expense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('layouts.dashboard', compact('user','expenses', 'dailyExpenses', 'weeklyExpenses', 'monthlyExpenses'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeExpense(Request $request)
    {
        $request->validate([
            'amount'=>'required|numeric|min:0',
            'date'=>'required|date',
            'description'=>'string|max:255|nullable',
        ]);
        Expense::create([
            'user_id'=>Auth::id(),
            'amount'=>$request->amount,
            'date'=>$request->date,
            'description'=>$request->description,
        ]);
        return back()->with('success','Espense added!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        if($expense->user_id !== auth()->id()){
            abort(403);
        }
        $request->validate([
            'amount'=>'required|numeric|min:0',
            'date'=>'required|date',
            'description'=>'string|max:255|nullable',
        ]);
        $expense->update($request->only([
            'amount',
            'date',
            'description',
        ]));
        return redirect()->route('dashboard')->with('success','تم التعديل!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroyExpense($id)
    {
        // $this->authorize('delete', $expense);
        $expenses=Expense::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('success', 'Expense deleted!');
    }
}
