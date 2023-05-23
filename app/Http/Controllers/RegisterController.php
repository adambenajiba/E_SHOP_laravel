<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;


class RegisterController extends Controller
{
    public function register(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Create a new user
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    // Assign the "customer" role to the user
    $customerRole = Role::where('slug', 'customer')->first();
    if ($customerRole) {
        $user->roles()->attach($customerRole);
    }

    // Redirect or perform any other actions after successful registration
    // For example, redirect to the home page
    return redirect('/home')->with('success', 'Registration successful!');
}
public function registerCustomer()
{
    return view('register');
}

}
