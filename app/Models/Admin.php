<?php

namespace App\Models;

use App\Enums\AdminRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'gender',
        'email',
        'password',
    ];

    protected static function booted(): void //thêm vào khi làm gì đó
    {
        static::creating(static function ($object) {
            $object->password =  Hash::make(123); //mặc định mật khẩu là 123 được mã hoá
            $object->role  = AdminRoleEnum::ADMIN; //mặc định nhân viên được thêm vào mang vai trò là admin
        });
//        static::saved(static function ($object) {
//
//        });
    }
    public function getRoleNameAttribute()
    {
        return AdminRoleEnum::getKeys($this->role)[0];
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Nam' : 'Nữ';
    }

    public function getFullNameAttribute() : string
    {
        return ucfirst($this->last_name) . ' ' . ucfirst($this->first_name);
    }
}
