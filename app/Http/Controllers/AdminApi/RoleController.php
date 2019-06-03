<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @var Role
     */
    private $role;

    function __construct(Role $role)
    {

        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
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
        ]);
        $role= $this->role->create([
            'name'=> $request->name
        ]);

        activity()
            ->performedOn(new Role())
            ->causedBy(auth()->user())
            ->withProperties([
                'name'=> $request->name
            ])
            ->log('created');

        if ($request->has('permissions')) {
            $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
        }

        return response(['message'=>'Role Created']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $role->update([
            'name'=> $request->name,
        ]);
        activity()
            ->performedOn(new Role())
            ->causedBy(auth()->user())
            ->withProperties([
                'name'=> $request->name
            ])
            ->log('updated');
        if ($request->has('permissions')) {
            $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
        }

        return response(['message'=>'Role Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->role->destroy($id);
    }
}
