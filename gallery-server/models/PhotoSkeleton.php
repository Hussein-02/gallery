<?php

class PhotoSkeleton
{

    public static $user_id;
    public static $title;
    public static $description;
    public static $tags;
    public static $image_path;

    public static function create($user_id, $title, $description, $tags, $image_path)
    {
        self::$user_id = $user_id;
        self::$title = $title;
        self::$description = $description;
        self::$tags = $tags;
        self::$image_path = $image_path;
    }
}
