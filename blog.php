<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog</title>
    <link href="css/fa.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body id="page-top">    
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'];?></span>
                                <img class="img-profile rounded-circle" src="<?php echo $_SESSION['profileImg'];?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="blog.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Blog
                                </a>
                                <a class="dropdown-item" href="blog-post.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Post a blog
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Blog</h1>
                    </div>
                    <div class="row">
                        <div class="">
                            <!--start of blogs list-->
                            <?php 
                            require 'posts.php';
                            require 'pagention.php';
                            
                            $post = new Posts();
                            $pagen = new Pagention( isset($_GET['page_num']) ? $_GET['page_num']:1 ,5);
                        
                        
                            $results = $post::getNumPage($pagen->limit,$pagen->offset);
                            foreach( $results as $posts):
                            ?>
                            <div class="card post-preview post-preview-featured lift mb-5 overflow-hidden" href="#!">
                                <div class="row g-0">
                                    <div class="col-lg-5">
                                        <img src="img/blog-1.jpg" class="w-100">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card-body">
                                            <div class="py-5">
                                                <h5 class="card-title"><?php echo $posts["post_name"]; ?></h5>
                                                <p class="card-text"><?php echo $posts["post_content"]; ?></p>
                                            </div>
                                            <a href="<?php echo '/mini_blog/blog-item.php?id='.$posts["post_id"]; ?>" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-light-600">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                                <span class="text">Read More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endforeach;
                            ?>
                            <style>
                                #div-nextPage{
                                    text-align:center;
                                }
                            </style>
                            <div id='div-nextPage'>
                            <button id="btn-prevPage">← Prev page </button><button id="btn-nextPage">Next page →</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        const btn = document.querySelector("#btn-nextPage")
        const btnPrev = document.querySelector("#btn-prevPage")
        // Get the URL of the current page
        const url = new URL(window.location.href);

        // Get the value of the "page_num" parameter
        const params = new URLSearchParams(url.search);
        const pageNum = params.get('page_num');
        const newPageNext = parseInt(pageNum)+1
        const newPagePrev = parseInt(pageNum)-1
        if(pageNum == null ) {
            window.location = '/mini_blog/blog.php?page_num=1'
        }
        btn.addEventListener('click',()=>{
            if(pageNum < <?php echo (floor(Posts::getAllPostsSum()['total_posts']/5))+1?>){
                window.location = '/mini_blog/blog.php?page_num='+newPageNext
                return;
            }
            btn.disabled = true;

        })
        btnPrev.addEventListener('click',()=>{
            if(newPagePrev > 0){
                const newPage = parseInt(pageNum)-1
                window.location = '/mini_blog/blog.php?page_num='+newPagePrev
                return;
            }
            btnPrev.disabled = true;

        })
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>