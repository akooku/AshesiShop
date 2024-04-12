<?php
session_start();
include('../settings/connection.php');

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result_order = mysqli_query($conn, $order_query);
    $row_order = mysqli_fetch_array($result_order);

    $invoice_number = $row_order['invoice_number'];
    $amount_due = $row_order['amount_due'];
}

if(isset($_POST['confirm_payment'])) {

    $payment_mode = $_POST['payment_mode'];

    $payment_query = "INSERT INTO payments (order_id, invoice_number, amount, payment_mode) VALUES ('$order_id', '$invoice_number', '$amount_due', '$payment_mode')";
    $result_payment = mysqli_query($conn, $payment_query);

    if ($result_payment) {
        echo "<script>alert('Payment successfully made!');</script>";
        $update_orders = "UPDATE orders SET order_status = 'Complete' WHERE order_id = '$order_id'";
        $result_update_orders = mysqli_query($conn, $update_orders);
        echo "<script>window.open('../users/profile.php?my_orders', '_self');</script>";
    } else {
        echo "<script>alert('Payment failed!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
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
<body class="payment-body">
    <div class="container my-5">
    <h1 class="text-center my-5">Confirm Payment</h1>
        <form action="" method="POST">
            <div class="form-outline text-center my-4 w-50 m-auto">
                <label class="form-label" for="invoice_number">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number; ?>" name="invoice_number" disabled>
            </div>
            <div class="form-outline text-center my-4 w-50 m-auto">
                <label class="form-label mt-5" for="amount">Amount</label>
                <input type="amount" class="form-control w-50 m-auto" value="<?php echo $amount_due; ?>" name="amount" disabled>
                <div class="form-outline text-center my-4 w-50 m-auto">
                <label class="form-label mt-1" for="payment_mode"></label>
                    <select name="payment_mode" class="form-select m-auto">
                        <option>Select Payment Mode</option>
                        <option>Bank</option>
                        <option>Momo</option>
                        <option>Cash on Delivery</option>
                        <option>Meal Plan</option>
                    </select>
                </div>
            <div class="form-outline text-center my-4 w-50 m-auto">
                <label class="form-label mt-5" for="submit"></label>
                <input type="submit" class="btn btn-custom-bg py-2 px-3" value="Confirm" name="confirm_payment">
            <div>
        </form>
    </div>
    
</body>
</html>