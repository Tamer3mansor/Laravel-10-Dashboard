<?php
namespace App\Models;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory, HasRolesAndPermissions;
    protected $table = 'admins';
    protected $guarded = ['id'];
    protected $fillable = ['name','email',  'password',];
    protected $hidden = ['password', 'remember_token'];
public function roles()
{return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');}
  protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // This line casts the password attribute to hashed
    ];
}
