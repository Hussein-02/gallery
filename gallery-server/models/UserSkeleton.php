<?php

class UserSkeleton
{

    public static $fullname;
    public static $email;
    public static $password;

    public static function create($fullname, $email, $password)
    {
        self::$fullname = $fullname;
        self::$email = $email;
        self::$password = $password;
    }
}
