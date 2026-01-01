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







