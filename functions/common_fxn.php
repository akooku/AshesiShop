<?php

// Include Connection File
// include('settings/connection.php');

// Fetching products
function fetchProducts() {
    global $conn;

    // Condition to check isset
    if (!isset($_GET['category'])) {
        // Select data from database
        $select_query = "SELECT * FROM products ORDER BY rand() LIMIT 0,9";
                $result_query = mysqli_query($conn, $select_query);
                
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_description = $row['product_description'];
                    $product_image = $row['product_image'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: GHS $product_price</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-custom-bg'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-custom-bg-2'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
    }
}

// Getting all products
function getAllProducts() {
    global $conn;

    // Condition to check isset
    if (!isset($_GET['category'])) {
        // Select data from database
        $select_query = "SELECT * FROM products ORDER BY rand()";
                $result_query = mysqli_query($conn, $select_query);
                
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_description = $row['product_description'];
                    $product_image = $row['product_image'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: GHS $product_price</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-custom-bg'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-custom-bg-2'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
    }
}

// Getting unique categories
function getUniqueCategories() {
    global $conn;

    // Condition to check isset
    if (isset($_GET['category'])) {
        $category_id=$_GET['category'];
        // Select data from database
        $select_query = "SELECT * FROM products WHERE category_id=$category_id ORDER BY rand()";
                $result_query = mysqli_query($conn, $select_query);
                $num_of_rows = mysqli_num_rows($result_query);
                
                if ($num_of_rows == 0) { 
                    echo '<div class="alert-2">No products found!</div>';
                }
                
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_description = $row['product_description'];
                    $product_image = $row['product_image'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: GHS $product_price</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-custom-bg'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-custom-bg-2'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
    }
}

function getCategories() {
    global $conn;
    $select_categories = "SELECT * FROM categories";
                    $result_categories = mysqli_query($conn, $select_categories);
                    
                    while ($row_data = mysqli_fetch_array($result_categories)) {
                        $category_name = $row_data['category_name'];
                        $category_id = $row_data['category_id'];
                        echo "<li class='nav-item'>
                                <a class='nav-link dropdown-item' href='index.php?category=$category_id'>$category_name</a>
                              </li>";
                    };
}

// Search Products
function searchProduct() {
    global $conn;

        $search_data_value = $_GET['search_data'];
        // Select data from database
        $search_query = "SELECT * FROM products WHERE product_keywords LIKE '%$search_data_value%'";
        $result_query = mysqli_query($conn, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
                
                if ($num_of_rows == 0) { 
                    echo '<div class="alert-2">No products found!</div>';
                }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_description = $row['product_description'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_name'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_name</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Price: GHS $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-custom-bg'>Add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-custom-bg-2'>View more</a>
                        </div>
                    </div>
                </div>";
        }
}

// View Product Details
function viewProductDetails() {
    global $conn;

    // Condition to check isset
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            $product_id=$_GET['product_id'];
            // Select data from database
            $select_query = "SELECT * FROM products WHERE product_id = $product_id";
                    $result_query = mysqli_query($conn, $select_query);
                    
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row['product_id'];
                        $product_name = $row['product_name'];
                        $product_description = $row['product_description'];
                        $product_image = $row['product_image'];
                        $product_price = $row['product_price'];
                        $category_id = $row['category_id'];
                        echo "<div>
                        <!-- Card -->
                        <div class='card mb-3'>
                            <div class='row g-0'>
                                <div class='col-md-4'>
                                    <img src='admin/product_images/$product_image' class='img-fluid rounded-start' alt='$product_name'>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                    <h5 class='card-title'>$product_name</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: GHS $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-custom-bg'>Add to cart</a>
                                        <button onclick='goBack()' class='btn btn-custom-bg-2'>Go back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }
        }
    }
}

// Get IP Address
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 

// Add to Cart
function addToCart() {
    global $conn;

    if(isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' AND product_id = '$get_product_id'";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('Product already in cart!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$get_product_id', '$ip', 1)";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Product successfully added to cart!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}

// Get Cart Item Numbers
function getCartItems() {
    global $conn;

    if(isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();

        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_query = mysqli_query($conn, $select_query);
        $cart_items = mysqli_num_rows($result_query);
        } else {
            $ip = getIPAddress();

            $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
            $result_query = mysqli_query($conn, $select_query);
            $cart_items = mysqli_num_rows($result_query);
        }
        echo $cart_items;
}

// Total Cart Price
function getCartPrice() {
    global $conn;
    $ip = getIPAddress();
    $total_price = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
    $result = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result_products = mysqli_query($conn, $select_products);

        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

?>

<script>
function goBack() {
  window.history.back();
}
</script>