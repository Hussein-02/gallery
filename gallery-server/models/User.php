<?php
require "UserSkeleton.php";
require __DIR__ . '/../connection/connection.php';

class User extends UserSkeleton
{

    public static function save()
    {
        global $conn;

        $sql = "INSERT INTO users (fullname,email,password) VALUES (?,?,?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sss", self::$fullname, self::$email, self::$password);
        $query->execute();

        return true;
    }

    public static function findByEmail($email)
    {
        global $conn;

        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", self::$email);
        $query->execute();

        $response = $query->get_result();
        $answer = $response->fetch_assoc();

        return $answer;
    }
};
