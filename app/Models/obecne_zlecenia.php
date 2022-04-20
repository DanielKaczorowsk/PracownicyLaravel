<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obecne_zlecenia extends Model
{
    use HasFactory;
    protected $fillable=['urzadzenie','usterka','uwaga','limitkosztow'];
    public function users()
    {
        return $this->belongsToMany(User::class,'obecne_users');
    }
}
