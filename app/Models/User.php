<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'username',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    // Relasi jika ada
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
