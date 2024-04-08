<?php
@session_start();
include('../settings/connection.php');
include('../functions/common_fxn.php');

if(isset($_POST['user_login'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM users WHERE user_email = '$user_email'";
    $select_result = mysqli_query($conn, $select_query);
    $user_exists = mysqli_num_rows($select_result);
    $row_data = mysqli_fetch_array($select_result);
    $user_ip = getIPAddress();

    // Cart Item
    $select_query_cart = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
    $select_result_cart = mysqli_query($conn, $select_query_cart);
    $num_of_rows_cart = mysqli_num_rows($select_result_cart);

    if ($user_exists > 0) {
        if (password_verify($user_password, $row_data['user_password'])){
            
            $_SESSION['username'] = $row_data['username'];

            if ($user_exists==1 && $num_of_rows_cart==0) {
                $_SESSION['username'] = $row_data['username'];
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
            } else {
                $_SESSION['username'] = $row_data['username'];
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        } else {
            echo '<div class="alert">Invalid password.</div>';
        }
    } else {
        echo "<div class='alert'>User does not exist!</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
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
    <div class="container-fluid card-2 w-30 my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <civ class="lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- User Email Field -->
                    <div class="form-outline">
                        <label class="form-label" for="user_email">Email</label>
                        <input type="text" id="user_email" placeholder="Enter your Ashesi email" class="form-control mb-4" name="user_email" autocomplete="off" required>
                    </div>
                    
                    <!-- User Password Field -->
                    <div class="form-outline">
                        <label class="form-label" for="user_password">Password</label>
                        <input type="password" id="user_password" placeholder="Enter your password" class="form-control mb-4" name="user_password" autocomplete="off" required>
                    </div>
                    
                    <!-- Login Button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="btn btn-custom-bg py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_register.php" class="text-danger">Register</a></p>
                    </div>

                </form>
            </civ>
        </div>
    </div>
    <!-- Scripts -->
    <?php
    include("../includes/scripts.php");
    ?>
</body>
</html>