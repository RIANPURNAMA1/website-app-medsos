<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function register(){
    return view('register.register');
  }

  public function registerStore(Request $request){
    $validasi = $request->validate([
       'name'=>'required',
       'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'email'=>'required|email|unique:users',
       'password'=>'required'
    ]);
     // Menghandle upload gambar
     if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $validasi['image'] = $imageName;
    }

    $validasi['password'] = Hash::make($validasi['password']);
    User::create($validasi);
   return redirect()->back()->with('success', 'register berhasil silahkan login');
  }


  public function setting($id){
    $user = User::find($id);
    return view('post.setting', compact('user'));
}

public function updateSetting(Request $request, $id)

{

    $user = User::find($id);

    $request->validate([
        'name' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required|email|unique:users,email,' . $id,
        'bio' => 'nullable',
        'current_password' => 'required',
        'new_password' => 'nullable|min:2|different:current_password',
        'new_password_confirmation' => 'same:new_password',
    ]);

    // Memeriksa apakah password lama sesuai
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Current password is incorrect');
    }

    // Menghandle upload gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $user->image = $imageName;
    }

    // Memeriksa apakah password baru diisi
    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->new_password);
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->bio = $request->bio;

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully');
}

}
