<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Add_User', ['only' => ['create','store']]);
        $this->middleware('permission:Show_User', ['only' => ['index','show']]);
        $this->middleware('permission:Update_User', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete_User', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $action = route('user.store');
        return view('user.form', compact('user', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        if($request->type == 0){
            $user->assignRole("regular_user");
        }elseif($request->type == 1){
            $user->assignRole("agent");
        }else  if($request->type == 2){
            $user->assignRole("admin");
        }

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $action = route('user.update', $id);
        return view('user.form', compact('user', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $user = User::find($id);
        if($request->type == 1){
            $user->assignRole("agent");
        }else  if($request->type == 2){
            $user->assignRole("admin");
        }
        $data = $request->validated();

        if($request->password != null){
            $data['password'] = Hash::make($data['password']);
        }


       $user->update($data);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

       $user->delete();
        return redirect()->route('user.index');
    }
}
