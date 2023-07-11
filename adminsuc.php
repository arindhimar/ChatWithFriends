<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>ChatWithFriends</title>
    <link rel="stylesheet" href="css/adminsuc.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/adminsuc.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name" style="padding-left: 15%;">CWF</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" id='navaccdisp'>
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Accounts</span>
                </a>
            </li>
            <li>
                <a href="#" id='navaddacc'>
                    <i class='bx bx-box'></i>
                    <span class="links_name" >Add Accounts</span>
                </a>
            </li>
            <li>
                <a href="#" id="navaddcat">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name" >Add Category</span>
                </a>
            </li>
            <li>
                <a href="#" id='navdispchat'>
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name" >Chats</span>
                </a>
            </li>
            
            <li class="log_out">
                <a href="login.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn' id='togglesidebar'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box" id="userSearch">
                <input type="text" placeholder="Search..." id='searchtxt'>
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <img src="images/defcard.jpg" alt="404">
                <span class="admin_name">Admin</span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>

        <div class="home-content">
            

            <div id='divaccdisp'>
                <div id='actstatus'>

                </div>
                <div class="row row-cols-1 row-cols-md-4 g-4" id='dispdata'>

                </div>

            </div>
            <div id='divaddacc'>

                <div id='addaccstatus'>

                </div>

                <form enctype="multipart/form-data">
                    <div class="m-3">
                        <label for="name" class="form-label">User's Name</label>
                        <input type="text" class="form-control" id="txtname" placeholder="Enter Name Here">
                    </div>
                    <div class="m-3">
                        <label for="email" class="form-label">User's Email</label>
                        <input type="text" class="form-control" id="txtemail" placeholder="Enter Email Here">
                    </div>
                    <div class="m-3">
                        <label for="password" class="form-label">User's Password</label>
                        <input type="password" class="form-control" id="txtpass" placeholder="Enter Password Here">

                    </div>
                    <div class="m-3">
                        <label for="ProfilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="imgfile" id="imgfile" placeholder="ProfilePicture(jpg/jpeg/png)<=5mb">

                    </div>
                    <div class="row g-3 m-2">
                        <label for="Interest" class="form-label">User's Interest</label>
                        <div class="col-sm-4">
                            <select class="form-select" id='act1' aria-label="Default select example">
                                <!-- <option selected>Open this select menu</option> -->
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select" id='act2' aria-label="Default select example">
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select" id='act3' aria-label="Default select example">
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary m-3" id='addaccbtn' style="width:97.2%">Submit</button>
                </form>
                <div class="card m-3" id='confirmaddacc'>
                    <div class="card-body">
                        <h5 class="card-title">Confrim Details</h5>
                        <p class="card-text">Please enter the admin password to confirm adding the details of the user</p>
                        <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                        <div>
                            <label for="password" class="form-label">Admin's Password</label>
                            <input type="password" class="form-control" id="txtadminpass" placeholder="Enter Password Here">
                            <button type="button" class="btn btn-primary mt-2" id='verifyadddbtn' style="width:97.2%">Verify</button>
                        </div>
                    </div>
                </div>

            </div>

            <div id='addcatdiv'>
                <div class="col d-flex justify-content-center">
                    <div class="card text-center " style="width: 50%;">
                        <div class="card-header">
                            <h5 class="card-title">Add Category</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="txtaddcat" placeholder="Enter New Category Here">
                            <a href="#" class="btn btn-primary mt-3" id='addcatbtn'>Add</a>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <div id='addcatstatus'>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center mt-3">

                    <div class="card text-center " style="width: 50%;">
                        <div class="card-header">
                            <h5 class="card-title">Available Category</h5>
                        </div>
                        <div class="card-body" id='avaicat'>

                        </div>
                    </div>
                </div>
            </div>

            <div id='divallchats'>

            </div>

        </div>



        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");

            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>

</body>

</html>