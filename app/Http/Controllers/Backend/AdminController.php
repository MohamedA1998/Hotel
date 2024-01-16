<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{


    public function AdminDashboard()
    {
        return view('admin.Dashboard');
    }

    
    public function AdminProfile()
    {
        return view('admin.AdminProfile');
    }


    public function AdminProfileUpdate( Request $request , User $user)
    {
        // $request->validate([]);

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->save();      

        if( $request->hasFile('photo') ){
            $path = $request->file('photo')->store('upload/user');

            if( $user->images ){
                Storage::delete($user->images->path);
                $user->images->path = $path;
                $user->images->save();
            }else{
                $user->images()->create([
                    'path'  => $path
                ]);
            }
        }
        
        return redirect()->back()->with($this->alert('success' , 'Profile Was Updated!!!'));
    }


    public function AdminChangePassword()
    {
        return view('admin.AdminChangePassword');
    }


    public function AdminPasswordUpdate(Request $request , User $user)
    {
        $request->validate([
            'old_password'      => 'required' ,
            'new_password'      => 'required|confirmed'
        ]);
        
        if( !Hash::check( $request->old_password , $user->password ) ){

            toastr()->error('Old Password Does Not Match !!!');

            return redirect()->back();

        }

        $user->update([
            'password'  => Hash::make( $request->new_password )
        ]);

        return redirect()->back()->with($this->alert('success' , 'Password Changed Successfuly !!'));
    }




    // ----------------------------------------------------
    public function AllAdmin()
    {
        return view('backend.pages.admin.all_admin' , [
            'alladmin'  => User::RoleEqualAdmin(),
        ]);
    }

    public function AddAdmin()
    {
        return view('backend.pages.admin.add_admin' , [
            'roles'  => Role::all() ,
        ]);
    }

    public function StoreAdmin( Request $request )
    {
        $user = new User();
        $user->name         = $request->name ;
        $user->email        = $request->email ;
        $user->phone        = $request->phone ;
        $user->address      = $request->address ;
        $user->password     = Hash::make($request->password) ;
        $user->role         = 'admin' ;
        $user->status       = 'active' ;
        $user->save();

        if( $request->roles ){
            $user->assignRole( $request->roles );
        }

        return redirect()->route('all.admin')->with('success' , 'Admin Was Created!!');
    }


    public function EditAdmin( $id )
    {
        return view('backend.pages.admin.edit_admin' , [
            'user'  => User::find( $id ) ,
            'roles' => Role::all(),
        ]);
    }


    public function UpdateAdmin(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();

        if ($request->roles) {
           $user->assignRole($request->roles);
        }
        
        return redirect()->route('all.admin')->with('success' , 'Admin User Updated Successfully!!');
    }// End Method 


    public function DeleteAdmin($id)
    {
        $user = User::find($id);

        if (!is_null($user)) {
            $user->delete();
        }
        
        return redirect()->back()->with('success' , 'Admin User Delete Successfully!!');
    }// End Method 








}
