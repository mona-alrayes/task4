<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    ///////////////////////////////////////////////
    //view admin dashboard with showing all users//
    ///////////////////////////////////////////////

    public function index()
    {
        $users = User::all();
        return view('admin', compact('users'));
    }

    //////////////////////////////////////////////////////////
    // Register new USER , This function just view the page///
    //////////////////////////////////////////////////////////

    public function view_register()
    {
        return view('register');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////
    /// Register new User , it takes the form in Post and handle it here then send it to database///
    /////////////////////////////////////////////////////////////////////////////////////////////// 

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255','string'],
            'email' => ['required','max:255','string','email','unique:users,email'],
            'password' => ['required','max:255','string','min:8'],
            'confirm_password' => ['required','max:255','string','min:8'],
        ]);
        if ( $request->password !== $request->confirm_password) {
            $request->errors()->add('password', 'The password and confirmation password do not match.');
        }
            USER::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
        
        return redirect('admin/register')->with('status', 'user been created');
    }

    //////////////////////////////////////////////////////////
    // update existing user , first function to view the page//
    //////////////////////////////////////////////////////////

    public function view_edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //update existing user , here in this function you update exisiting user data and send it to database///
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update(Request $request, int $id)
{
    $user = User::findOrFail($id);

    if ($user->name == 'admin') {
        return redirect()->back()->with('status', 'You cannot update the super admin account.');
    }

    $request->validate([
        'name' => ['required','max:255','string'],
        'email' => ['required','max:255','string','email',Rule::unique('users')->ignore($user->id),],
        'new_password' => ['nullable','max:255','string','min:8'],
        'confirm_password' => ['nullable','max:255','string','min:8'],
    ]);

    if ($request->new_password !== null && $request->new_password !== $request->confirm_password) {
        return redirect()->back()->withErrors(['new_password' => 'The new password and confirmation password do not match.'])->withInput();
    }

    // Update user details
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role
    ]);

    // Update password if provided
    if ($request->new_password !== null) {
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
    }

    return redirect()->back()->with('status', 'User has been updated.');
}


    ////////////////////////////////////////////////////
    //changing role of the user and send it to database//
    /////////////////////////////////////////////////////

    public function role($id)
    {
        $user = User::findOrFail($id);
        if ($user->name == 'admin') {
            return redirect()->back()->with('status', 'you can not change the role of super admin');
        }
        if ($user->role == 1) {
            $user->role = 0;
        } else {
            $user->role = 1;
        }
        $user->save();
        return redirect()->back()->with('status', 'user have been Updated');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //delete the account with the passed ID with exception that if the ID refers to admin account then refuse this request//
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete(int $id)
    {
        $user = User::find($id);
        if ($user->name == 'admin') {
            return redirect()->back()->with('status', 'you can not delete the super admin account');
        } else {
            $user->delete();
        }
        return redirect()->back()->with('status', 'user have been Deleted');
    }
}
