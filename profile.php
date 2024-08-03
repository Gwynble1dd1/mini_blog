<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}


?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="./js/profile.js" defer></script>
    <script src="./js/helper.js" defer></script>
</head>
<body id="page-top"> 
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
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                        
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    
                                    <img width='400px' class="img-account-profile rounded-circle mb-2" src="<?php echo $_SESSION['profileImg'];?>" alt="">
                                    
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <div class="small font-italic text-muted mb-4">Drop File to Update profile image</div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form>
                                        <!-- Form Group (username)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo  $_SESSION['username']; ?>">
                                            <button class="btn btn-primary" id="upd_name" type="button">Update username</button>
                                        </div>
                                        <!-- Form Row-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputFirstName">Change password</label>
                                            <input class="form-control" id="inputFirstName" type="text" placeholder="Enter new password" value="">
                                            <button class="btn btn-primary" id="upd_pass" type="button">update password</button>
                                        </div>
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUserDesc">User description</label>
                                            <input class="form-control" id="inputUserDesc" type="email" placeholder="User description" value="<?php echo  $_SESSION['userDesc']; ?>">
                                        <button class="btn btn-primary" id="upd_desc" type="button">update User description</button>

                                        </div>
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            
                                        </div>
                                        <!-- Save changes button-->
                                    </form>
                                </div>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>