<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    
    public function AllPermission()
    {
        return view('backend.pages.permission.all_permission' , [
            'permissions'   => Permission::latest()->get(),
        ]);
    }


    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }


    public function StorePermission( Request $request )
    {
        Permission::create([
            'name'          => $request->name ,
            'group_name'    => $request->group_name
        ]);

        return redirect()->route('all.permission')->with($this->alert('success' , 'Permission Created Successfuly'));
    }


    public function EditPermission( $id )
    {
        return view('backend.pages.permission.edit_permission' , [
            'permission'    => Permission::find( $id ) ,
        ]);
    }


    public function UpdatePermission( Request $request )
    {
        Permission::find( $request->id )->update([
            'name'          => $request->name ,
            'group_name'    => $request->group_name
        ]);

        return redirect()->route('all.permission')->with($this->alert('success' , 'Permission Updated Successfuly'));
    }


    public function DeletePermission( $id )
    {
        Permission::find( $id )->delete();

        return redirect()->route('all.permission')->with($this->alert('success' , 'Permission Deleted Successfuly'));
    }


    public function ImportPermission()
    {
        return view('backend.pages.permission.import_permission');
    }


    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }


    public function Import( Request $request )
    {
        Excel::import(new PermissionImport, $request->file('import_file') );

        return redirect()->route('all.permission')->with($this->alert('success' , 'Permission Imported Successfuly'));
    }


    // ------------------------------ 

    public function AllRoles()
    {
        return view('backend.pages.roles.all_roles' , [
            'roles'   => Role::latest()->get(),
        ]);
    }

    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }


    public function StoreRoles( Request $request )
    {
        Role::create([
            'name'  => $request->name
        ]);
        
        return redirect()->route('all.roles')->with($this->alert('success' , 'Roles Created Successfuly'));
    }
    

    public function EditRoles( $id )
    {
        return view('backend.pages.roles.edit_roles' , [
            'roles'    => Role::find( $id ) ,
        ]);
    }


    public function UpdateRoles( Request $request )
    {
        Role::find( $request->id )->update([
            'name'          => $request->name ,
        ]);

        return redirect()->route('all.roles')->with($this->alert('success' , 'Roles Updated Successfuly'));
    }


    public function DeleteRoles( $id )
    {
        Role::find( $id )->delete();

        return redirect()->route('all.roles')->with($this->alert('success' , 'Roles Deleted Successfuly'));
    }










    public function AddRolesPermission()
    {
        return view('backend.pages.rolesetup.add_roles_permission' , [
            'roles'                 => Role::all() ,
            'permissions'           => Permission::all(),
            'permission_groups'     => User::getpermissionGroups()
        ]);
    }


    public function RolePermissionStore( Request $request )
    {
        foreach ($request->permission as $item) {
            DB::table('role_has_permissions')->insert([
                'role_id'   => $request->role_id ,
                'permission_id' => $item ,
            ]);
        }

        return redirect()->route('all.roles.permission')->with($this->alert('success' , 'Roles Permission Added Successfuly'));
    }


    public function AllRolesPermission()
    {
        return view('backend.pages.rolesetup.all_roles_permission' , [
            'roles' => Role::all()  ,
        ]);
    }








    public function AdminEditRoles($id)
    {
        return view('backend.pages.rolesetup.edit_roles_permission',[
            'role'              => Role::find($id) ,
            'permissions'       => Permission::all() ,
            'permission_groups' => User::getpermissionGroups() 
        ]);

    }// End Method


    public function AdminRolesUpdate(Request $request,$id)
    {
        $role = Role::find($id);

        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        
        return redirect()->route('all.roles.permission')->with($this->alert('success' , 'Role Permission Updated Successfully'));
    }// End Method


    public function AdminDeleteRoles($id)
    {
        $role = Role::find($id);
        
        if (!is_null($role)) {
           $role->delete();
        }
        
        return redirect()->route('all.roles.permission')->with($this->alert('success' , 'Role Permission Deleted Successfully'));
    }// End Method


}
