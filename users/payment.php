<?php
@session_start();
include('../settings/connection.php');
include('../functions/common_fxn.php');
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
    
</head>
<body>
    <!-- Accessing User ID -->
    <?php
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM users WHERE user_ip = '$user_ip'";
    $run_user = mysqli_query($conn, $get_user);
    $row_user = mysqli_fetch_array($run_user);
    $user_id = $row_user['user_id'];
    ?>
    <div class="container">
        <h2 class="text-center custom-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../assets/images/payment.png" class="card-img-top img-fluid rounded-start" alt="Paypal App">
                    <div class="card-body">
                        <a href="https://www.paypal.com" target="_blank" class="btn btn-custom-bg-2 px-3 py-2 me-3">Pay with PayPal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../assets/images/payment-off.png" class="card-img-top img-fluid rounded-start" alt="Offline Payment">
                    <div class="card-body">
                        <a href="order.php?user_id=<?php echo $user_id; ?>" class="btn btn-custom-bg px-3 py-2 me-3">Pay Offline</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <?php
    include("../includes/scripts.php");
    ?>
</body>
</html>