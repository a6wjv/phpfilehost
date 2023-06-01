<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\AdminRole;
class RoleController extends Controller
{
    public function roleList(Request $request)
    {
        $search = $request['search'] ? $request['search'] : "";
        if (($search !== "")) {
            $allRoles = AdminRole::where('name', 'LIKE', "%$search%")->orderby('created_at','ASC')->paginate(10);
        } else {
            $allRoles = AdminRole::orderby('created_at','ASC')->paginate(20);
        }
        return view('roles.role-list', compact('allRoles','search'));
    }
    public function insertRole(Request $request)
    {
        AdminRole::create([
            'name' => $request->roleName
        ]);
        Session::flash('message', 'Role Added Successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    public function editBatch(Request $request)
    {
        return AdminRole::where('id', $request->id)->first();
    }
    public function updateRole(Request $request)
    {
        AdminRole::where('id', $request->id)->update([
            'name' => $request->roleName
        ]);
        Session::flash('message', 'Role Updated Successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    public function deleteRole(Request $request)
    {
        AdminRole::where('id', $request->id)->delete();
        Session::flash('message', 'Role Deleted Successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
