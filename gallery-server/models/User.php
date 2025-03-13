<?php
require "UserSkeleton.php";
require __DIR__ . '/../connection/connection.php';

class User extends UserSkeleton
{

    public static function save()
    {
        global $conn;

        $hashedPassword = hash('sha256', self::$password);

        $sql = "INSERT INTO users (full_name,email,password) VALUES (?,?,?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sss", self::$fullname, self::$email, $hashedPassword);
        $query->execute();

        return true;
    }

    public static function findByEmail($email)
    {
        global $conn;

        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $response = $query->get_result();
        if ($answer = $response->fetch_assoc()) {

            return $answer;
        } else {
            return null;
        }
    }
};
