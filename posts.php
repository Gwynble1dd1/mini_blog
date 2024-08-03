<?php

class Posts {
    private static $db;

    public function __construct() {
        self::$db = new PDO("mysql:host=127.0.0.1;dbname=blog", "root", "");
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getAllPostsSum() {
        $query = "SELECT COUNT(post_id) AS total_posts FROM posts;";
        $cursor = self::$db->prepare($query);
        $cursor->execute();
        return $cursor->fetch();
    }
    public static function getPostById($id) {
        $query = "SELECT * FROM posts WHERE post_id=:id;";
        $cursor = self::$db->prepare($query);
        $cursor->bindValue(":id", $id, PDO::PARAM_INT);
        $cursor->execute();
        return $cursor->fetch();
    }

    public static function getNumPage($limit, $offset) {
        $query = "SELECT * FROM posts ORDER BY post_id LIMIT :limit OFFSET :offset";
        $cursor = self::$db->prepare($query);
        $cursor->bindValue(":limit", $limit, PDO::PARAM_INT);
        $cursor->bindValue(":offset", $offset, PDO::PARAM_INT);
        $cursor->execute();
        return $cursor->fetchAll(PDO::FETCH_ASSOC);
    }
}
