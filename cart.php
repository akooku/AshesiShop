<!-- Include Connection File -->
<?php
session_start();
include('settings/connection.php');
include('functions/common_fxn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
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
            <a class="navbar-brand" href="index.php">Ashesi Shop</a>
            
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
                    <?php
                    if(!isset($_SESSION['username'])) {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="login/register.php">Sign Up</a>
                    </li>';
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='users/profile.php'>My Account</a>
                    </li>";
                    }
                    ?>
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

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><span class="cart-items"><?php getCartItems(); ?></span></sup></a>
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
                            <a class="nav-link" href="login/login.php">Login</a>
                        </li>';
                    } else {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="login/logout.php">Logout</a>
                        </li>';
                    }
                    ?>
                </ul>
    </nav>
    <!-- Navigation Bar -->

    <!-- Cart Page -->
    <!-- Cart Page Title -->
    <h3 class='text-center'>Cart Details</h3>

    <!-- Cart Page Content -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">
                    
                        <!-- Display Cart Items -->
                        <?php 

                        $ip = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
                        $result = mysqli_query($conn, $cart_query);
                        $row_number = 1;
                        $result_count = mysqli_num_rows($result);

                        if ($result_count > 0) {
                            echo "<thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Image</th>
                                <th scope='col'>Item</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Quantity</th>
                                <th scope='col'>Total</th>
                                <th scope='col'>Remove</th>
                                <th scope='col' colspan='2'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";
                            $result_products = mysqli_query($conn, $select_products);
                    
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = array($row_product_price['product_price']);

                                $price_table = $row_product_price['product_price'];
                                $product_name = $row_product_price['product_name'];
                                $product_image = $row_product_price['product_image'];

                                $product_values = array_sum($product_price);
                                $total_price += $product_values;
                            

                        ?>
                        <tr>
                            <th scope="row"><?php echo $row_number++; ?></th>
                            <td>
                                <img src='admin/product_images/<?php echo $product_image; ?>' class="cart-img" alt='<?php echo $product_name; ?>'>
                            </td>
                            <td><?php echo $product_name; ?></td>
                            <td>GHS <?php echo $price_table; ?></td>
                            <td>
                                <div class="input-group justify-content-center">
                                <?php
                                // Fetch quantity from the database
                                $quantity_query = "SELECT quantity FROM cart_details WHERE product_id = '$product_id' AND ip_address = '$ip'";
                                $result_quantity = mysqli_query($conn, $quantity_query);
                                $row_quantity = mysqli_fetch_assoc($result_quantity);
                                $stored_quantity = $row_quantity['quantity'];
                                ?>

                                    <div class="input-group justify-content-center">
                                        <input type="number" class="form-input w-50 input-number text-center quantity-input" name="quantity" value="<?php echo $stored_quantity; ?>" min="1" max="50" data-product-id="<?php echo $product_id; ?>">
                                    </div>

                                    <?php
                                    $ip = getIPAddress();
                                    if(isset($_POST['update_cart'])) {
                                        $new_quantity = $_POST['quantity'];
                                        $update_cart = "UPDATE cart_details SET quantity = '$new_quantity' WHERE product_id = '$product_id' AND ip_address = '$ip'";
                                        $result_update_cart = mysqli_query($conn, $update_cart);
                                        $updated_price = $price_table*$new_quantity;
                                        $total_price=$total_price*$new_quantity;
                                        echo "<input type='hidden' name='product_id' value='$product_id'>";
                                    }
                                    ?>
                                    <span class="input-group-btn"></span>
                                </div>
                            </td>
                            <td>GHS <?php echo isset($updated_price) ? $updated_price : $price_table; ?></td>
                            <td>
                                <input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>">
                            </td>
                            <td>
                                
                                <input type="submit" value="Update Cart" class="btn btn-custom-bg-2 px-3 py-2 me-3" name="update_cart">

                                <input type="submit" value="Remove Item" class="btn btn-custom-bg px-3 py-2 me-3" name="remove_items">
                            </td>
                        </tr>

                        <?php
                        }
                    }
                } else {
                    echo "<tr>
                            <td colspan='7' class='alert-2 text-center'>No Items in Cart</td>
                        </tr>";
                }
                        ?>
                    </tbody>
                </table>

                <!-- Subtotal -->
                <div class="d-flex mb-5">
                    <?php
                    
                    $ip = getIPAddress();
                    $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
                    $result = mysqli_query($conn, $cart_query);
                    $result_count = mysqli_num_rows($result);

                        if ($result_count > 0) {
                            
                            echo "<h4 class='px-3 mt-2'>Subtotal: <strong class='custom-info'>GHS " . $total_price . "</strong></h4>";

                            echo "<input type='submit' value='Continue Shopping' class='btn btn-custom-bg px-3 py-2 me-3' name='continue_shopping'>
                            
                            <input type='submit' value='Checkout' class='btn btn-custom-bg-2 px-3 py-2 me-3' name='checkout'>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='btn btn-custom-bg px-3 py-2 me-3' name='continue_shopping'>";
                        };
                        if(isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self');</script>";
                        }
                        if(isset($_POST['checkout'])) {
                            echo "<script>window.open('users/checkout.php','_self');</script>";
                        }
                    
                    ?>
                </div>
            </form>

            <!-- Remove Items -->
            <?php
            
            function removeItem() {
                global $conn;
                if(isset($_POST['remove_items'])) {
                    foreach($_POST['removeitem'] as $remove_id ) {
                        echo $remove_id;
                        $delete_query = "DELETE FROM cart_details WHERE product_id = $remove_id";
                        $result_delete = mysqli_query($conn, $delete_query);
                        if ($result_delete) {
                            echo "<script>window.open('cart.php','_self');</script>";
                        }
                    }
                }
            }
            echo $remove_item = removeItem();
            
            ?>
        </div>
    </div>

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