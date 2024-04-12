<?php
include('../settings/connection.php');
include('../functions/common_fxn.php');
?>

<!-- Saving Registration Details -->
<?php

if (isset($_POST['user_register'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $retype_password = $_POST['retype_password'];
    $user_address = $_POST['user_address'];
    $user_phone = $_POST['user_phone'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Select query
    $select_query = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result_query = mysqli_query($conn, $select_query);
    $user_exists = mysqli_num_rows($result_query);
    if ($user_exists > 0) {
        echo "<div class='alert'>User already exists!</div>";
    } else if ($user_password != $retype_password) {
        echo "<div class='alert'>Passwords do not match!</div>";
    } else {
        move_uploaded_file($user_image_temp, "user_images/$user_image");
        // Insert query
        $insert_query = "INSERT INTO users (username,user_email,user_password,user_image,user_ip,user_address,user_phone) VALUES ('$username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_phone')";
        $result = mysqli_query($conn, $insert_query);
        if ($result) {
            echo "<script>alert('User Registered Successfully!');</script>";
        } else {
            die(mysqli_error($conn));
        }
        }

        // Selecting Cart Items
        $select_cart_items = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
        $result_cart_items = mysqli_query($conn, $select_cart_items);

        // Counting Cart Items
        $count_cart_items = mysqli_num_rows($result_cart_items);
        if($count_cart_items>0) {
            $_SESSION['username'] = $username;
            echo "<script>alert('You have items in your cart!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        } else {
            echo "<script>window.open('../index.php','_self')</script>";
        }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">New User Registration</h1>
        <div class="row d-flex align-items-center justify-content-center">
            <civ class="lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data" id="registration-form">

                    <!-- Username Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="username">Username</label>
                        <input type="text" id="username" placeholder="Enter your username" class="form-control" name="username" autocomplete="off" required>
                        <div id="username-error" class="invalid-feedback"></div>
                    </div>
                    <!-- User Email Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="user_email">Ashesi Email</label>
                        <input type="text" id="user_email" placeholder="Enter your Ashesi email" class="form-control" name="user_email" autocomplete="off" required>
                        <div id="user_email-error" class="invalid-feedback"></div>
                    </div>
                    
                    <!-- User Mobile Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="user_phone">Phone Number</label>
                        <input type="text" id="user_phone" placeholder="Enter your phone number" class="form-control" name="user_phone" autocomplete="off">
                        <div id="user_phone-error" class="invalid-feedback"></div>
                    </div>
                    <!-- User Image Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="user_image">Profile Picture</label>
                        <input type="file" id="user_image" class="form-control" name="user_image">
                        <div id="user_image-error" class="invalid-feedback"></div>
                    </div>
                    <!-- User Address Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="user_address">Address (Room Number and Hostel Name)</label>
                        <input type="text" id="user_address" placeholder="i.e. A4 Wangari Mathai" class="form-control" name="user_address" autocomplete="off">
                        <div id="user_address-error" class="invalid-feedback"></div>
                    </div>
                    
                    <!-- User Password Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="user_password">Password</label>
                        <input type="password" id="user_password" placeholder="Enter your password" class="form-control" name="user_password" autocomplete="off" required>
                        <div id="user_password-error" class="invalid-feedback"></div>
                    </div>
                    <!-- Retype User Password Field -->
                    <div class="form-outline">
                        <label class="form-label mt-4" for="retype_password">Confirm Password</label>
                        <input type="password" id="retype_password" placeholder="Confirm your password" class="form-control" name="retype_password" autocomplete="off" required>
                        <div id="retype_password-error" class="invalid-feedback"></div>
                    </div>
                    <!-- Register Button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="btn btn-custom-bg py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                    </div>
                    <div id="error-messages"></div>


                </form>
            </div>
        </div>
    </div>
    <?php include('../includes/scripts.php'); ?>
</body>
</html>