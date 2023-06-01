<?php

namespace App\Http\Controllers\MenuManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleMenu;
use App\Models\AdminRole;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
class MenuManagementController extends Controller
{
    public function menuManagement()
    {
        $roles = AdminRole::all();
        $menus = Menu::all();
        $roleMenus = RoleMenu::get();
        return view('menumanagement.menumanagement-view', compact('roles', 'menus', 'roleMenus'));
    }

    public function setMenu(Request $request)
    {
        $data = array(
            'role_id' => $request->role_id,
            'menu_id' => implode(',', $request->menu_id)
        );
        RoleMenu::updateOrCreate(['role_id' => $request->role_id,], $data);
        Session::flash('message', 'Menu Assigned Successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
