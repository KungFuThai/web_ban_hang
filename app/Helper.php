<?php

if (!function_exists('checkSuperAdmin')) { //làm xong đem nó bỏ vào auto load trong phần file composer.json rồi chạy lệnh composer dump-autoload để load lại
    function checkSuperAdmin() : bool
    {
        return session('admin.role') === 0;
    }
}
if (!function_exists('checkProductInCart')) { //làm xong đem nó bỏ vào auto load trong phần file composer.json rồi chạy lệnh composer dump-autoload để load lại
    function checkProductInCart() : bool
    {
        if(session('cart'))
            return true;
        return false;
    }
}