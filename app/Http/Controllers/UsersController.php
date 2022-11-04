<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        if (request('search')) {
            $users = Users::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $users = Users::all();
        }
        return view('users.index')->with('users', $users);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'datebirth' => 'required',
            'sex' => 'required',
            'city' => 'required',
        ]);

        Users::create($request->post());

        return redirect()->route('users.index')->with('success','User has been created successfully.');
    }
    public function show(Users $user)
    {
        return view('users.show',compact('user'));
    }
    public function edit(Users $user)
    {
        return view('users.edit',compact('user'));
    }
    public function update(Request $request, Users $user)
    {
        $request->validate([
            'name' => '',
            'surname' => '',
            'datebirth' => '',
            'sex' => '',
            'city' => '',
        ]);

        $user->fill($request->post())->save();

        return redirect()->route('users.index')->with('success','User Has Been updated successfully');
    }
    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','User has been deleted successfully');
    }
    public function calculate(Users $user)
    {
        $birthday_timestamp = strtotime($user->datebirth);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;
    }
}
