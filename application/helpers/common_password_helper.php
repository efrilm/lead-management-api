<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('hash_password')) {
    function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

if (!function_exists('verify_password')) {
    function verify_password($password, $hash_password)
    {
        return password_verify($password, $hash_password);
    }
}

if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 3)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
