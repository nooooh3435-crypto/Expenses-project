<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'تم تحديث بيانات المستخدم');
    }

    // حذف مستخدم
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم');
    }
}




// namespace App\Http\Controllers\Auth;
// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Models\Expense;
// use Illuminate\Http\Request;
// use Illuminate\Validation\Rules\Password;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;





// class UserController extends Controller
// {
//     public function indexRegister()
//     {
//         return view('auth.register');
//     }

//     public function storeRegister(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email',
//             'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password)
//         ]);
//         Auth::login($user);

//         return redirect()->route('dashboard');


//     }

//     public function indexLogin()
//     {
//         return view('auth.login');
//     }

//     public function storeLogin(Request $request)
//     {
//         $credentials = $request->validate([
//             ' email' => 'required|email',
//             'password' => ['required|', Password::min(8)->numbers()->mixedCase()->symbols()->letters()],
//         ]);
//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();
//             return redirect()->route('dashboard');
//         }
//         return back()->withErrors([
//             'email' => 'The provided data don`t macth our records.',
//         ]);
//     }
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect()->route('login');
//     }
//     public function indexDash()
//     {
//         $user = Auth::user();
//         $expenses = Expense::where('user_id', $user->id)->latest()->get();
//         $totalMonth = Expense::where('user_id', $user->id)->whereMonth('created_at', now()->month)->sum('amount');
//         return view('dashboard', compact('expenses', 'totalMonth'));
//     }
// }



