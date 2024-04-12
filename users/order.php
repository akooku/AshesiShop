<?php
@session_start();
include('../settings/connection.php');
include('../functions/common_fxn.php');

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Get total price and items
    $user_ip = getIPAddress();
    $total_price = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
    $result_cart_price = mysqli_query($conn, $cart_query);
    $invoice_number = mt_rand();
    $status = 'pending';
    $num_of_rows_cart_price = mysqli_num_rows($result_cart_price);
    while($row_price=mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
}

// Get Product Quantity
$get_cart = "SELECT * FROM cart_details";
$result_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($result_cart);
$quantity = $get_item_quantity['quantity'];
$subtotal = $total_price * $quantity;

// Insert into orders table
$insert_query = "INSERT INTO orders (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ($user_id, $subtotal, $invoice_number, $num_of_rows_cart_price, NOW(), '$status')";
$result_query_orders = mysqli_query($conn, $insert_query);

if ($result_query_orders) {
    echo "<script>alert('Order successfully placed!');</script>";

        // Get the order_id of the newly inserted order
        $order_id = mysqli_insert_id($conn);

        // Loop through cart items to insert pending orders
        $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
        $result_cart_price = mysqli_query($conn, $cart_query);

        while ($row_price = mysqli_fetch_array($result_cart_price)) {
            $product_id = $row_price['product_id'];
            $quantity = $row_price['quantity'];

            // Insert pending order for each product in the cart
            $insert_pending = "INSERT INTO pending (order_id, user_id, invoice_number, product_id, quantity, order_status) VALUES ('$order_id', '$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
            $result_query_pending = mysqli_query($conn, $insert_pending);
        }

        // Delete Items from Cart
        $empty_cart = "DELETE FROM cart_details WHERE ip_address='$user_ip'";
        $result_empty_cart = mysqli_query($conn, $empty_cart);

    echo "<script>window.location.href='profile.php';</script>";
}

// // Get Order ID
// $get_order_id = "SELECT * FROM orders WHERE invoice_number = '$invoice_number'";
// $result_order_id = mysqli_query($conn, $get_order_id);
// $get_order_id = mysqli_fetch_array($result_order_id);
// $order_id = $get_order_id['order_id'];

// // Orders Pending
// $insert_pending = "INSERT INTO pending (order_id, user_id, invoice_number, product_id, quantity, order_status) VALUES ($order_id, $user_id, $invoice_number, $product_id, $quantity, '$status')";
// $result_query_pending = mysqli_query($conn, $insert_pending);

// // Delete Items from Cart
// $empty_cart = "DELETE FROM cart_details WHERE ip_address='$user_ip'";
// $result_empty_cart = mysqli_query($conn, $empty_cart);
// echo "<script>window.location.href='profile.php';</script>";

?>