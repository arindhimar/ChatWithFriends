<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>ChatWithFriends</title>
    <link rel="stylesheet" href="css/usersuc.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/usersuc.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name" style="padding-left: 15%;">CWH</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" id='navaccdisp'>
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Accounts</span>
                </a>
            </li>
            <li>
                <a href="#" id='chatnavdiv'>
                    <i class='bx bx-box'></i>
                    <span class="links_name">ChatWithFriends</span>
                </a>
            </li>
            <li>
                <a href="#" id='navshowfr'>
                    <i class='bx bx-list-ul' ></i>
                    <span class="links_name">Friends</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Total order</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Messages</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Favrorites</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
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
            <div class="search-box">
                <div class="row g-3 m-2">
                    <div class="col-sm-5"><input type="text" placeholder="Search..." id='searchtxt'>
                    </div>

                    <div class="col-sm-5">

                        <select class="form-select " id='act1' aria-label="Default select example">

                        </select>
                    </div>
                </div>

            </div>
            <div class="profile-details">
                <img src="images/defcard.jpg" alt="404">
                <span class="admin_name">Admin</span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>

        <div class="home-content">
            <!-- <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Order</div>
                        <div class="number">40,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-cart-alt cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Sales</div>
                        <div class="number">38,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-add cart two'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Profit</div>
                        <div class="number">$12,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-cart cart three'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Return</div>
                        <div class="number">11,086</div>
                        <div class="indicator">
                            <i class='bx bx-down-arrow-alt down'></i>
                            <span class="text">Down From Today</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-download cart four'></i>
                </div>
            </div> -->

            <!-- <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Recent Sales</div>
                    <div class="sales-details">
                        <ul class="details">
                            <li class="topic">Date</li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                            <li><a href="#">02 Jan 2021</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Customer</li>
                            <li><a href="#">Alex Doe</a></li>
                            <li><a href="#">David Mart</a></li>
                            <li><a href="#">Roe Parter</a></li>
                            <li><a href="#">Diana Penty</a></li>
                            <li><a href="#">Martin Paw</a></li>
                            <li><a href="#">Doe Alex</a></li>
                            <li><a href="#">Aiana Lexa</a></li>
                            <li><a href="#">Rexel Mags</a></li>
                            <li><a href="#">Tiana Loths</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Sales</li>
                            <li><a href="#">Delivered</a></li>
                            <li><a href="#">Pending</a></li>
                            <li><a href="#">Returned</a></li>
                            <li><a href="#">Delivered</a></li>
                            <li><a href="#">Pending</a></li>
                            <li><a href="#">Returned</a></li>
                            <li><a href="#">Delivered</a></li>
                            <li><a href="#">Pending</a></li>
                            <li><a href="#">Delivered</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Total</li>
                            <li><a href="#">$204.98</a></li>
                            <li><a href="#">$24.55</a></li>
                            <li><a href="#">$25.88</a></li>
                            <li><a href="#">$170.66</a></li>
                            <li><a href="#">$56.56</a></li>
                            <li><a href="#">$44.95</a></li>
                            <li><a href="#">$67.33</a></li>
                            <li><a href="#">$23.53</a></li>
                            <li><a href="#">$46.52</a></li>
                        </ul>
                    </div>
                    <div class="button">
                        <a href="#">See All</a>
                    </div>
                </div>
                <div class="top-sales box">
                    <div class="title">Top Seling Product</div>
                    <ul class="top-sales-details">
                        <li>
                            <a href="#">
                                <img src="images/sunglasses.jpg" alt="">
                                <span class="product">Vuitton Sunglasses</span>
                            </a>
                            <span class="price">$1107</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/jeans.jpg" alt="">
                                <span class="product">Hourglass Jeans </span>
                            </a>
                            <span class="price">$1567</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/nike.jpg" alt="">
                                <span class="product">Nike Sport Shoe</span>
                            </a>
                            <span class="price">$1234</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/scarves.jpg" alt="">
                                <span class="product">Hermes Silk Scarves.</span>
                            </a>
                            <span class="price">$2312</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/blueBag.jpg" alt="">
                                <span class="product">Succi Ladies Bag</span>
                            </a>
                            <span class="price">$1456</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Gucci Womens's Bags</span>
                            </a>
                            <span class="price">$2345</span>
                        <li>
                            <a href="#">
                                <img src="images/addidas.jpg" alt="">
                                <span class="product">Addidas Running Shoe</span>
                            </a>
                            <span class="price">$2345</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/shirt.jpg" alt="">
                                <span class="product">Bilack Wear's Shirt</span>
                            </a>
                            <span class="price">$1245</span>
                        </li>
                    </ul>
                </div>
            </div> -->

            <div id='divaccdisp'>
                <div id='addfriendstatus'>

                </div>
                <div class="row row-cols-1 row-cols-md-4 g-4" id='dispdata'>

                </div>

            </div>
            <div id='chatdiv' class="container text-center" style="width: 100%;">
                <div class="row" style="width: 100%;">
                    <div id='chatcontacts' style="background-color: red;" class="col-sm-4">
                        <h1>asdasdas</h1>
                    </div>
                    <div id='chatscreen' style="width: 75%;background-color: blue;" class="col-sm-8">
                        <h1>asdasd</h1>
                    </div>
                </div>
            </div>


            <div id='divallfriends'>
                <div class="row row-cols-1 row-cols-md-4 g-4" id='fralldata'>

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