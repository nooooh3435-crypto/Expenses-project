<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function show()
{
    $user = auth()->user();
    $profile = $user->profile; // علاقة One-to-One
    return view('layouts.profile', compact('user', 'profile'));
}

public function update(Request $request)
{
    $user = auth()->user();
    $profile = $user->profile;

    $data = $request->validate([
        'nick_name' => 'nullable|string|max:255',
        'occupation' => 'nullable|string|max:255',
        'salary' => 'nullable|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('profiles', 'public');
    }

    $profile->update($data);

    return redirect()->route('profile.show')->with('success', 'تم تحديث البيانات بنجاح!');
}




    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Profile $profile)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Profile $profile)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Profile $profile)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Profile $profile)
    // {
    //     //
    // }
}
