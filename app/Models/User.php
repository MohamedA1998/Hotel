<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // Image Relationships Morph
    public function images(): MorphOne
    {
        return $this->morphOne(Image::class , 'imagable');
    }
    

    public function blogpost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }


    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups; 
    }

    public static function getpermissionByGroupName($group_name)
    {

        $permissions = DB::table('permissions')
                            ->select('name','id')
                            ->where('group_name',$group_name)
                            ->get();
            return $permissions;
    }


    public static function roleHasPermissions($role,$permissions){
        $hasPermission = true;
        foreach ($permissions as $permission) {
           if (!$role->hasPermissionTo($permission->name)) {
            $hasPermission = false;
           }
           return $hasPermission;
        }
    }// End Method 


    


    // Start Scopes
    public function scopeLoginByNameOrEmailOrPhone( Builder $query , $input ): Builder
    {
        return $query->where('email' , $input)->orWhere('name' , $input)->orWhere('phone' , $input);
    }

    public function scopeRoleEqualAdmin( Builder $query )
    {
        return $query->where('role' , 'admin')->get();
    }



    
}
