<?php
require "photoSkeleton.php";
require __DIR__ . '/../connection/connection.php';

class Photo extends PhotoSkeleton
{

    public static function save()
    {
        global $conn;

        $sql = "INSERT INTO photos (user_id,title,description,tags,image_path) VALUES (?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->bind_param("issss", self::$user_id, self::$title, self::$description, self::$tags, self::$image_path);
        $query->execute();

        return true;
    }

    public static function all($user_id)
    {
        global $conn;

        $sql = "SELECT * FROM photos WHERE user_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("i", $user_id);
        $query->execute();

        $response = $query->get_result();
        $photos = [];
        while ($row = $response->fetch_assoc()) {
            $photos[] = $row;
        }

        return $photos;
    }

    public static function update($photo_id, $title, $description, $tags, $image_path = null)
    {
        global $conn;

        //if image provided update image path
        if ($image_path) {
            $sql = "UPDATE photos SET title = ?, description = ?, tags = ?, image_path = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $query->bind_param("ssssi", $title, $description, $tags, $image_path, $photo_id);
        } else {
            //if no new image just update meta data
            $sql = "UPDATE photos SET title = ?, description = ?, tags = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $query->bind_param("sssi", $title, $description, $tags, $photo_id);
        }

        $query->execute();

        return true;
    }

    public static function delete($id)
    {
        global $conn;

        $sql = "DELETE FROM photos WHERE id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        return true;
    }
};
