<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'avatar',
        'gender',
        'birth_date',
        'phone',
        'address',
        'email',
        'password',
    ];
    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birth_date), date_create())->y;
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
