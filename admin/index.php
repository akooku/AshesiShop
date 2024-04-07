<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
    <link rel="stylesheet" href="../assets/styles/admin.css">
</head>
<body>
    <!-- NavBar -->
    <div class="container-fluid p-0">
        <!-- Primary NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
            <div class="container-fluid">
                <!-- Navbar brand -->
                <div class="navbar-brand-container">
                    <img src="../assets/images/logo.png" alt="Ashesi Logo" class="logo">
                    <a class="navbar-brand" href="#">Ashesi Shop</a>
                </div>

                <nav class="navbar navbar-expand-lgv">
                    <ul class="navbar-nav">
                        <li clas="nav-item">
                            <div class="navbar-brand-container">
                                <img src="../assets/images/profile.jpg" alt="Profile Picture" class="profile-pic">
                                <a class="nav-link" href="">Welcome Guest</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Secondary NavBar -->
        <div>
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- Tertiary NavBar -->
        <div class="row">
            <div class="col-md-12 p-1 align-items-center">
                <div>
                    <p class="text-dark text-center">Business Name</p>
                </div>
            </div>
            <div class="button text-center">
                <button><a href="../actions/insert_product.php" class="nav-link btn btn-custom-bg my-1">Insert Products</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">View Products</a></button>
                <button><a href="index.php?insert_category" class="nav-link btn btn-custom-bg my-1">Insert Categories</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">View Categories</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">All Orders</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">All Payments</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">List Users</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">Pending Businesses</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg my-1">Approved Businesses</a></button>
                <button><a href="" class="nav-link btn btn-custom-bg-2 my-1">Logout</a></button>
            </div>
        </div>
    </div>
    <!-- NavBar -->

    <!-- Content Page -->
    <div class="container my-3">
        <?php
        if(isset($_GET['insert_category'])){
            include('../actions/insert_categories.php');
        }
        ?>
    </div>
    <!-- Content Page -->

    <!-- Footer -->
    <div class="custom-bg p-3 text-center footer">
        <p>All rights reserved ©- Designed by Ako Oku (82022025)</p>
    </div>

    <!-- Footer -->
    
    <!-- Bootstrap JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JS -->
    <script src="../assets/scripts/alert.js"></script>


</body>
</html>