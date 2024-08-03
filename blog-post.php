<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/post-blog.css">
    <script src="./js/helper.js" defer></script>
    <script defer src="./js/blog-post.js"></script>
    <title>Document</title>
</head>
<body>
<style>
    #msg-span{
        position: absolute;
        top: 100px;
        right: 50px;
        /*height: 50px;*/
        padding: 10px;
        width: 400px;
        background-color: #f44336;
        color: #fff;
        text-align: center;
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
        border-radius: 5px;
        opacity: 0;
        transition: all 1.5s;
        cursor: pointer;
        z-index: 999;
    }
</style>
<span id="msg-span">
    
</span> 
    <section id="body-section">
        <div id="panel">
            <div id="panel-header">
                <div>
                    <h2>Post a blog, <?php echo $_SESSION['username']; ?></h2>
                </div>

            </div>
            <div id="panel-body">
                <div>
                    <label for="Title">Title</label><br>
                    <input id="Title" type="text" placeholder="Title">
                </div>
                <div>
                    <label for="content">content</label><br>
                    <input id="content" type="text" placeholder="content">
                </div>
                <div>
                    <label for="file-upload">Click to upload an image</label><br>
                    <input name="file-upload" id="file-upload" type="file">
                </div>
                <div>
                    <button type="submit" id="add_post">submit</button>
                </div>
                <a href="/mini_blog/blog.php">back to blog</a>
            </div>
        </div>
    </section>
</body>
</html>