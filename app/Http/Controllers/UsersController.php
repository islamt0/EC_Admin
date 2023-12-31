<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){        
        $users = User::get();
        return view('pages.users.users.users_list', compact('users') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse {

      $data=  $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'age' => 'required|string',
            'role'=> 'required|string',
            'country'=> 'required|string',
            'password'=>'required|string'
        ]);
        User::create( $data);
        return redirect('Users/UserList')->with(['success' => 'Adding new User successfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $users = User::find($id);
       
        return view('pages.users.users.view',compact('users') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $user = User::find($id);
        return view('pages.users.users.edit',compact('user'));
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {

      
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'age' => 'required|string',
            'role'=> 'required|string',
            'country'=> 'required|string',
            'password'=>'required|string'
        ]);
        
        User::where('id' , $id)->update($data);
        return redirect('Users/UsersList')->with(['success' => 'Updated User successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      User::where('id',$id)->delete();
     return redirect('Users/UserList')->with('success','Deleted successfuly');

    }
}
