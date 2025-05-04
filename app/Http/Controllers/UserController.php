<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Appliquer le middleware 'auth' à toutes les méthodes sauf 'index'
        $this->middleware('admin')->except('update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $groups = Group::all();
        return view('admin.users.index', compact('users', 'groups'));
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
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $data['password'] = Hash::make("Bungalow@2024");
        User::create( $data );

        return back()->with(['message'=>__('locale.save', ['param'=>__('locale.user', ['suffix'=>'', 'prefix'=>''])])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except(['_token', 'password_confirmation']);
        $user = User::find($id);

        if(!empty($data['password']))
            $data['password'] = Hash::make($data['password']);
        
        $user->update($data);

        return back()->with(['message'=>__('locale.update', ['param'=>__('locale.password')])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with(['message'=>__('locale.delete', ['param'=>__('locale.user', ['suffix'=>'', 'prefix'=>''])])]);
    }
}
