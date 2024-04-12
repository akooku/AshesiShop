<?php
session_start();
include('../settings/connection.php');
include('../functions/common_fxn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - <?php echo $_SESSION['username']; ?> </title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
    <link rel="stylesheet" href="../assets/styles/profile.css">

</head>
<body>
    <!-- Navigation Bar -->
    <!-- Primary Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
        <div class="container-fluid p-0">
            <!-- Navbar brand -->
            <img src="../assets/images/logo.png" alt="Ashesi Logo" class="logo">
            <a class="navbar-brand" href="../index.php">Ashesi Shop</a>
            
            <!-- Navbar toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../all_products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Businesses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <!-- Search form -->
                <form class="d-flex m-auto" action="" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search products" aria-label="Search" name="search_data">
                    <input type="submit" value="Search" class="btn btn-outline-light btn-custom-bg" name="search_data_product">
                </form>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><span class="cart-items"><?php getCartItems(); ?></span></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: GHS <?php getCartPrice(); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Calling Cart Function -->
    <?php
    addToCart();
    ?>

    <!-- Secondary Navigation Bar -->
    <nav class="navbar navbar-secondary navbar-expand-lg">
                <ul class="navbar-nav me-auto">
                    
                    <?php
                    if(!isset($_SESSION['username'])) {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#">Welcome Guest</a>
                    </li>';
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome, ".$_SESSION['username']."!</a>
                    </li>";
                    }

                    if(!isset($_SESSION['username'])) {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../login/login.php">Login</a>
                        </li>';
                    } else {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../login/logout.php">Logout</a>
                        </li>';
                    }
                    ?>
                </ul>
    </nav>
    <!-- Navigation Bar -->

    <!-- Home Page -->
    <!-- Home Page Title -->

    <!-- Home Page -->
    <!-- Displaying User NavBar -->
    <div class="row">
        <div class="col-md-2 p-0">
            <ul class="navbar-nav user-nav me-auto text-center border border-dark rounded">
                <li class="nav-item user-custom-bg">
                    <a class="nav-link active" aria-current="page" href="#"><h4>Your Profile</h4></a>
                </li>
                <?php
                
                $username = $_SESSION['username'];
                $user_image = "SELECT * FROM users WHERE username = '$username'";
                $result_image = mysqli_query($conn, $user_image);
                $row_image = mysqli_fetch_array($result_image);
                $user_image = $row_image['user_image'];
                echo " <div class='navbar-brand-container text-center my-2'>
                <img src='user_images/$user_image' alt='Profile Picture' class='profile-pic'>
            </div>";
                
                ?>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="profile.php">Pending Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="profile.php?edit_account">Edit Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="profile.php?my_orders">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="profile.php?delete_account">Delete Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="../login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- Displaying User Details -->
        <div class="col-md-10">
                <!-- Fetching Details -->
                <?php 
                
                if (isset($_GET['search_data_product'])) {
                    searchProductProfile();
                } else {
                    getOrderDetails();
                    if (isset($_GET['edit_account'])) {
                        include('../actions/edit_user_account.php');
                    }
                    if (isset($_GET['my_orders'])) {
                        include('user_orders.php');
                    }
                    if (isset($_GET['delete_account'])) {
                        include('../actions/delete_user_account.php');
                    }
                }
                
                ?>

        <!-- Column End -->
        </div>
    </div>

    <!-- Footer -->
    <?php 
    include("../includes/footer.php"); 
    ?>
    <!-- Footer -->

    <!-- Scripts -->
    <?php
    include("../includes/scripts.php");
    ?>
</body>
</html>