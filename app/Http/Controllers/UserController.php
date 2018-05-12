<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show');
    }

    public function userAccount(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $ordersLimit = $request->ordersLimit ? : 5;
        $orders = $user->orders()->orderByDesc('created_at')->limit($ordersLimit)->get();
        return view('users.account', compact('user', 'orders', 'ordersLimit'));
    }

    public function userAccountUpdate(Request $request)
    {
        if ($request->password) {
            $updateData = $request->all();
        }else {
            $updateData = $request->except('password');
        }
        $validator = Validator::make($updateData, User::rules());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->password) {
            $updateData['password'] = bcrypt($updateData['password']);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->update($updateData);
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/account');
    }

    public function traderStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->can_trade = $request->status_id;
        $user->save();
        return redirect()->back();
    }
}
