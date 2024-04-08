<?php
session_start();
include('../settings/connection.php');
include('../functions/common_fxn.php');

if(isset($_POST['business_login'])) {
    $business_email = $_POST['business_email'];
    $business_password = $_POST['business_password'];

    $select_query = "SELECT * FROM business WHERE business_email = '$business_email'";
    $select_result = mysqli_query($conn, $select_query);
    $business_exists = mysqli_num_rows($select_result);
    $row_data = mysqli_fetch_array($select_result);

    if ($business_exists > 0) {
        if (password_verify($business_password, $row_data['business_password'])) {
            $_SESSION['business_id'] = $row_data['business_id'];
            $_SESSION['business_email'] = $row_data['business_email'];
            $_SESSION['business_name'] = $row_data['business_name'];
            $_SESSION['business_owner'] = $row_data['business_owner'];

            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.open('dashboard.php', '_self')</script>";
        } else {
            echo '<div class="alert">Invalid password.</div>';
        }
    } else {
        echo "<div class='alert'>Business does not exist!</div>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Login Page</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
</head>
<body>
    <div class="card-2 container-fluid my-3">
        <h2 class="text-center">Business Login Page</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">

                    <!-- Business Email Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_email">Business Email</label>
                        <input type="email" id="business_email" placeholder="Enter your business email" class="form-control mb-4" name="business_email" autocomplete="off" required>
                    </div>
                    
                    <!-- Business Password Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_password">Password</label>
                        <input type="password" id="business_password" placeholder="Enter your password" class="form-control mb-4" name="business_password" required>
                    </div>
                    
                    <!-- Login Button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="btn btn-custom-bg py-2 px-3 border-0" name="business_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="business_register.php" class="text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
