<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agent;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:user-list', ['only' => ['index']]),
            new Middleware('permission:user-create', ['only' => ['create', 'store']]),
            new Middleware('permission:user-edit', ['only' => ['edit', 'update']]),
            new Middleware('permission:user-delete', ['only' => ['destroy']]),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $users = User::with('roles')->get();
            return Datatables::of($users)->make(true);
        }


        return view('admin.users.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function create(): View
    {
        $roles = Role::all();

        return view('admin.users.create',['roles'=> $roles]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // : RedirectResponse
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        if ($request->agent_id) {
            $user->agent_id = $request->agent_id;
        }


        // user photo
        if ($request->file('photo')) {
            $cover = $request->file('photo');
            $image_full_name = time().'photo'.'.'.$cover->getClientOriginalExtension();
            $upload_path = 'images/users/';
            $image_url = $upload_path.$image_full_name;
            $success = $cover->move($upload_path, $image_full_name);
            $user->photo = $image_url;
        }
        $user->save();

        $user->assignRole($request->role);
        return redirect()->route('users.index')->with(['status' => 200, 'message' => 'User Created!']);

    }



    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Role::all();
        $agents = Agent::all();
        $user = User::with('agency')->findOrFail($id); // Corrected query
        return view('admin.users.show', ['user' => $user, 'roles' => $roles, 'agents' => $agents]);
    }


    // show all roles and user roles
    public function showUserRoles(Request $request, $id){
        $user = User::find($id);
        $roles = Role::all();
        $userRoles =  $user->roles;

        return response()->json([
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    // role assignment
    public function assignrole(Request $request){
        $roles = Role::all();
        $user = User::find($request->userid);
        $user->assignRole($request->rolename);
        $userRoles =  $user->roles;

        return response()->json([
            'success' => 'Role Assigned',
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    // role unassignment
    public function unassignrole(Request $request){
        $roles = Role::all();
        $user = User::find($request->userid);
        $user->removeRole($request->rolename);
        $userRoles =  $user->roles;

        return response()->json([
            'success' => 'Role Unassigned',
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.edit',compact('user','roles','userRole'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  : RedirectResponse
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // user photo
        if ($request->file('photo')) {
            // Delete old photo
            if ($user->photo) {
                unlink($user->photo);
            }
            $cover = $request->file('photo');
            $image_full_name = time() . 'photo' . '.' . $cover->getClientOriginalExtension();
            $upload_path = 'images/users/';
            $image_url = $upload_path . $image_full_name;
            $success = $cover->move($upload_path, $image_full_name);
            $user->photo = $image_url;
        }

        $user->update();


        return redirect()->route('users.index')->with(['status' => 200, 'message' => 'User updated successfully']);

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
        // Delete old photo
        if ($user->photo) {
            unlink($user->photo);
        }
        $user->delete();
        return response()->json(['success' => 'User deleted !']);
    }





    public function createAgentUser(Request $request)
    {
        $agents = Agent::all();
        $roles = Role::where('name', 'agent')->get();
        return view('admin.users.agentcreate',['roles'=> $roles, 'agents'=>$agents]);
    }

}
