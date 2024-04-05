<!-- Include Connection File -->
<?php
include('settings/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesi Shop</title>
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
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Businesses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <!-- Search form -->
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search products" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: GHS 1000</a>
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
    <!-- Home Page Title -->
    <h3 class="text-center">Popular Products</h3>

    <!-- Home Page Content -->
    <div class="row">
        <!-- Displaying Products -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <img src="assets/images/beauty/beauty1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-custom-bg">Add to cart</a>
                            <a href="#" class="btn btn-custom-bg-2">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 p-0">
            <!-- Displaying Categories -->
                <ul class="navbar-nav me-auto text-center border border-dark rounded">
                    <li class="nav-item category-custom-bg">
                        <a class="nav-link active" aria-current="page" href="#"><h4>Categories</h4></a>
                    </li>
                    <?php
                    
                    $select_categories = "SELECT * FROM categories";
                    $result_categories = mysqli_query($conn, $select_categories);
                    
                    while ($row_data = mysqli_fetch_array($result_categories)) {
                        $category_name = $row_data['category_name'];
                        $category_id = $row_data['category_id'];
                        echo "<li class='nav-item'>
                                <a class='nav-link dropdown-item' href='index.php?category=$category_id'>$category_name</a>
                              </li>";
                    };
                    
                    ?>
                </ul>
        </div>
    </div>

    <!-- Home Page -->

    <!-- Footer -->
    <div class="custom-bg p-3 text-center">
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
</body>
</html>