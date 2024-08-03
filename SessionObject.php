<?php

class SessionObject
{
    

    public function __construct()
    {
        $this->MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=blog", "root", "");
        $this->MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function login($username,$password)
    {
        try
        {
            $cursor = $this->MySQLdb->prepare("SELECT user_id,username,profile_image,user_description FROM users WHERE username=:username AND password=:password");
            $rows = $cursor->execute([":username"=>$username,":password"=>$password]);
            $result = $cursor->fetchAll();
            if(empty($result)){
                return array("status"=>false,"data"=>"user/password dosent match");
                exit(0);
            }
            
            
            return array("status"=>true,"data"=>$result);
        }
        catch(PDOException $e)
        {
            return $e;
        }
        return false;
    }


    public function register($username,$password)
    {
        try
        {
            $cursor = $this->MySQLdb->prepare("INSERT INTO users (username, password) 
            SELECT :username, :password 
            WHERE NOT EXISTS (
              SELECT * FROM users WHERE username = :username
            );
            ");
            $rows = $cursor->execute([":username"=>$username,":password"=>$password]);
            $result = $cursor->rowCount();
            if($result === 0){
                return array("status"=>false,"data"=>"user already exists");
                exit(0);
            }
            
            
            return array("status"=>true,"data"=>"register success!");
        }
        catch(PDOException $e)
        {
            return $e;
        }
        return false;
    }

    public function updateUsername($user_id, $username)
    {
    try {
        $cursor = $this->MySQLdb->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $cursor->execute([":username" => $username]);
        $result = $cursor->fetchColumn();
        if ($result > 0) {
            return array("status" => false, "data" => "Username already exists");
        }

        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user_id;
        $cursor = $this->MySQLdb->prepare("UPDATE users SET username = COALESCE(NULLIF(:username, ''), username) WHERE user_id = :user_id");
        $rows = $cursor->execute([
            ":user_id" => $user_id,
            ":username" => $username
        ]);

        return array("status" => true, "data" => "User profile updated successfully!");
        } catch (PDOException $e) {
            return array("status" => false, "data" => $e->getMessage());
        }
    }


    public function updatePassword($user_id, $password=null)
    {
    try {
        $cursor = $this->MySQLdb->prepare("UPDATE users SET password = COALESCE(NULLIF(:password, ''), password) WHERE user_id = :user_id");
        $rows = $cursor->execute([
            ":user_id" => $user_id,
            ":password" => $password,
        ]);
        return array("status" => true, "data" => "User password updated successfully!");
        } catch (PDOException $e) {
            return array("status" => false, "data" => $e->getMessage());
        }
    }

    public function updateDescription($user_id, $userDesc)
    {
    try {
        $_SESSION['userId'] = $user_id;
        $_SESSION['userDesc'] = $userDesc;
        $cursor = $this->MySQLdb->prepare("UPDATE users SET user_description = COALESCE(NULLIF(:userDesc, ''), user_description) WHERE user_id = :user_id");
        $rows = $cursor->execute([
            ":user_id" => $user_id,
            ":userDesc" => $userDesc,
        ]);

        return array("status" => true, "data" => "User profile updated successfully!");
        } catch (PDOException $e) {
            return array("status" => false, "data" => $e->getMessage());
        }
    }


    public function updateProfileImage($user_id, $upload_file)
    {
        try {
            $cursor = $this->MySQLdb->prepare("UPDATE users SET profile_image = :profile_image WHERE user_id = :user_id");
            $cursor->execute([":profile_image" => $upload_file, ":user_id" => $user_id]);
            
            return array("status" => true, "data" => "Profile image updated successfully");
            
        } catch (PDOException $e) {
            return array("status" => false, "data" => $e->getMessage());
        }
    }

    public function addPost($post_name, $post_username, $post_content, $upload_file)
    {
        try {
            $cursor = $this->MySQLdb->prepare("INSERT INTO posts (post_name, post_username, post_content, post_image, post_views) VALUES (:post_name, :post_username, :post_content, :post_image, '1');");
            $cursor->execute([
                ":post_name" => $post_name, 
                ":post_username"=> $post_username, 
                ":post_content" => $post_content, 
                ":post_image"=> $upload_file]);
            
            return array("status" => true, "data" => "Post made successfully");
            
        } catch (PDOException $e) {
            return array("status" => false, "data" => $e->getMessage());
        }
    }

    
}

?>