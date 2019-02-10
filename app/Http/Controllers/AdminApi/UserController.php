<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required',
        ]);
        $user= User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        if ($request->has('roleId')) {
            $user->assignRole($request->roleId);
        }

        if ($request->has('permissionIds')) {
            $user->givePermissionTo($request->permissionIds);
        }

        return response(['message'=>'User Created', 'user'=>$user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
        ]);

        if ($request->has('roleId')) {
            $user->syncRoles($request->roleId);
        }

        if ($request->has('permissionIds')) {
            $user->syncPermissions($request->permissionIds);
        }

        return response(['message'=>'User Updated', 'user'=>$user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
