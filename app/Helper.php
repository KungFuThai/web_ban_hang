<?php

use App\Enums\AdminRoleEnum;

if (!function_exists('isAdmin')) { //làm xong đem nó bỏ vào auto load trong phần file composer.json rồi chạy lệnh composer dump-autoload để load lại 1 lần duy nhất là được
    function isAdmin() : bool
    {
        return session()->has('admin.role');
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin() : bool
    {
        return session('admin.role') === AdminRoleEnum::SUPER_ADMIN;
    }
}

if (!function_exists('isCustomer')) {
    function isCustomer() : bool
    {
        return session()->has('customer.id');
    }
}

if (!function_exists('checkProductInCart')) {
    function checkProductInCart() : bool
    {
        if(session('cart'))
            return true;
        return false;
    }
}