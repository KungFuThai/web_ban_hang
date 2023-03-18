<?php

if (!function_exists('checkSuperAdmin')) { //làm xong đem nó bỏ vào auto load trong phần file composer.json rồi chạy lệnh composer dump-autoload để load lại
    function checkSuperAdmin() : bool
    {
        return session()->get('role') === 0;
    }
}