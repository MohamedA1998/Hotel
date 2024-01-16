<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    
    public function index()
    {
        return view('backend.setting.smtp' , [
            'smtp'  => SmtpSetting::first()
        ]) ;
    }
    

    public function update(Request $request, SmtpSetting $setting)
    {
        $setting->update([
            'mailer'        => $request->mailer ,
            'host'          => $request->host ,
            'port'          => $request->port ,
            'username'      => $request->username ,
            'password'      => $request->password ,
            'encryption'    => $request->encryption ,
            'from_address'  => $request->from_address ,
        ]);

        return redirect()->back()->with($this->alert('success' , 'SMTP Setting Was Updated!!!'));
    }
    

    public function SiteSettingIndex()
    {
        return view('backend.setting.site_setting' , [
            'site'  => SiteSetting::first()
        ]) ;
    }


    public function SiteSettingUpdate(Request $request, SiteSetting $site)
    {
        // {{-- // ['logo' , 'phone , 'address' , 'email' , 'facebook' , 'twitter' , 'copyright' ] --}}
        $site->update([
            'phone'        => $request->phone ,
            'address'      => $request->address ,
            'email'        => $request->email ,
            'facebook'     => $request->facebook ,
            'twitter'      => $request->twitter ,
            'copyright'    => $request->copyright ,
        ]);

        if( $request->hasFile('logo') ){
            $path = $request->file('logo')->store('upload/site');
            
            if( $site->images ){
                Storage::delete($site->images->path);
                $site->images->path = $path ;
                $site->images->save();
            }else{
                $site->images()->create([
                    'path'  => $path 
                ]);
            }
        }

        return redirect()->back()->with($this->alert('success' , 'Site Setting Was Updated!!!'));
    }



}
