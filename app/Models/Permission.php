<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable=[];
    public function role()
    {
      return $this->belongsToMany(Role::class,'permission_roles')
    }
    public function users()
    {
      return $this->belongsToMany(User::class,'permission_users')
    }
}
