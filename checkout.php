<!-- Include Connection File -->
<?php
include('settings/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/styles/navbar.css">
    <link rel="stylesheet" href="assets/styles/product.css">

</head>
<body>
    <!-- Navigation Bar -->
    <!-- Primary Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
        <div class="container-fluid p-0">
            <!-- Navbar brand -->
            <img src="assets/images/logo.png" alt="Ashesi Logo" class="logo">
            <a class="navbar-brand" href="#">Ashesi Shop</a>
            
            <!-- Navbar toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Businesses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Secondary Navigation Bar -->
    <nav class="navbar navbar-secondary navbar-expand-lg">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome Guest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                </ul>
    </nav>
    <!-- Navigation Bar -->

    <!-- Home Page -->
    <!-- Checkout Page Title -->
    <h3 class='text-center'>Checkout Page</h3>;

    <!-- Home Page Content -->
    <div class="row px-1">
        <!-- Displaying Products -->
        <div class="col-md-12">
            <div class="row">
                <?php
                if(!isset($_SESSION['username'])) {
                    include('users/user_login.php');
                } else {
                    include('payment.php');
                }
                ?>

            <!-- Row End -->
            </div>
        <!-- Column End -->
        </div>
    </div>

    <!-- Home Page -->

    <!-- Footer -->
    <?php 
    include("includes/footer.php"); 
    ?>
    <!-- Footer -->

    <!-- Scripts -->
    <?php
    include("includes/scripts.php");
    ?>
</body>
</html>