<?php
include('../settings/connection.php');
include('../functions/common_fxn.php');
?>

<!-- Saving Registration Details -->
<?php

if (isset($_POST['business_register'])) {
    $business_name = $_POST['business_name'];
    $business_owner = $_POST['business_owner'];
    $business_description = $_POST['business_description'];
    $business_email = $_POST['business_email'];
    $business_phone = $_POST['business_phone'];
    $business_snap = $_POST['business_snap'];
    $business_ig = $_POST['business_ig'];
    $business_site = $_POST['business_site'];
    $business_password = $_POST['business_password'];
    $hash_password = password_hash($business_password, PASSWORD_DEFAULT);
    $retype_password = $_POST['retype_password'];
    $business_img = $_FILES['business_img']['name'];
    $business_img_temp = $_FILES['business_img']['tmp_name'];
    $product_status = 'false';

    // Select query
    $select_query = "SELECT * FROM business WHERE business_email = '$business_email' AND business_name = '$business_name'";
    $result_query = mysqli_query($conn, $select_query);
    $business_exists = mysqli_num_rows($result_query);
    if ($business_exists > 0) {
        echo '<div class="alert">Business already registered!</div>';
    } else if ($business_password != $retype_password) {
        echo '<div class="alert">Passwords do not match!</div>';
    } else{
    move_uploaded_file($business_img_temp, "business_images/$business_img");

    $insert_query = "INSERT INTO business (business_name,business_owner,business_description,business_email,business_phone,business_snap,business_ig,business_site,business_img,status,date,business_password) VALUES ('$business_name','$business_owner','$business_description','$business_email','$business_phone','$business_snap','$business_ig','$business_site','$business_img','pending',NOW(), '$hash_password')";
    $result = mysqli_query($conn, $insert_query);
    if ($result) {
        echo '<div class="alert">Business successfully registered. Pending approval.</div>';
    } else {
        die(mysqli_error($conn));
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">New Business Registration</h1>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Business Name Field -->
                    <div class="    ">
                        <label class="form-label" for="business_name">Business Name</label>
                        <input type="text" id="business_name" placeholder="Enter your business name" class="form-control mb-4" name="business_name" autocomplete="off" required>
                    </div>
                    <!-- Business Owner Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_owner">Business Owner</label>
                        <input type="text" id="business_owner" placeholder="Enter your name" class="form-control mb-4" name="business_owner" autocomplete="off" required>
                    </div>
                    <!-- Business Description Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_description">Business Description</label>
                        <textarea id="business_description" placeholder="Enter your business description" class="form-control mb-4" name="business_description" rows="3" autocomplete="off" required></textarea>
                    </div>
                    <!-- Business Image Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_img">Business Logo</label>
                        <input type="file" id="business_img" class="form-control mb-4" name="business_img">
                    </div>
                    <!-- Business Email Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_email">Business Email</label>
                        <input type="email" id="business_email" placeholder="Enter your business email" class="form-control mb-4" name="business_email" autocomplete="off" required>
                    </div>
                    <!-- Business Phone Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_phone">Business Phone</label>
                        <input type="tel" id="business_phone" placeholder="Enter your business phone number" class="form-control mb-4" name="business_phone" autocomplete="off" required>
                    </div>
                    <!-- Business Social Media Fields -->
                    <div class="form-outline">
                        <label class="form-label" for="business_snap">Snapchat (if applicable)</label>
                        <input type="text" id="business_snap" placeholder="Enter your Snapchat handle" class="form-control mb-4" name="business_snap">
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="business_ig">Instagram (if applicable)</label>
                        <input type="text" id="business_ig" placeholder="Enter your Instagram handle" class="form-control mb-4" name="business_ig">
                    </div>
                    <!-- Business Website Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_site">Business Website (if applicable)</label>
                        <input type="url" id="business_site" placeholder="Enter your business website URL" class="form-control mb-4" name="business_site">
                    </div>
            
                    <!-- Business Password Field -->
                    <div class="form-outline">
                        <label class="form-label" for="business_password">Password</label>
                        <input type="password" id="business_password" placeholder="Enter your password" class="form-control mb-4" name="business_password" required>
                    </div>
                    <!-- Retype Business Password Field -->
                    <div class="form-outline">
                        <label class="form-label" for="retype_password">Confirm Password</label>
                        <input type="password" id="retype_password" placeholder="Confirm your password" class="form-control mb-4" name="retype_password" required>
                    </div>
                    <!-- Register Button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="btn btn-custom-bg py-2 px-3 border-0" name="business_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already registered? <a href="business_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
