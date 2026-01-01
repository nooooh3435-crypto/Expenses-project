<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile as ProfilerProfile;

class ProfileController extends Controller
{
   public function show()
   {
    $user = auth()->user();
    if ($user->profile) {
        $profile = $user->profile;
    }else {
        $profile = null;
    }

    return view('layouts.profile', compact('user', 'profile'));
   }


    public function store(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;
        $data=$request->validate([
        'Nick_name' => 'nullable|string|max:255',
        'Occupation' => 'nullable|string|max:255',
        'Salary' => 'nullable|numeric',
        'Image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'user_id'=> 'required|exists:user_id'

]);
    }




public function update(Request $request)
{
    $user = auth()->user();
    $profile = $user->profile;

    $data = $request->validate([
        'Nick_name' => 'nullable|string|max:255',
        'Occupation' => 'nullable|string|max:255',
        'Salary' => 'nullable|numeric',
        'Image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'user_id'=> 'required|exists:user_id'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('profiles', 'public');
    }

    $profile->update($data);

    return redirect()->route('profile.show')->with('success', 'تم تحديث البيانات بنجاح!');
}



}