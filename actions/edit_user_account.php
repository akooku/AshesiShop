<?php

if (isset($_SESSION['username'])) { 
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM users WHERE username = '$user_session_name'";
    $select_result = mysqli_query($conn, $select_query);
    if ($select_result) {
        $row_fetch = mysqli_fetch_assoc($select_result);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_phone = $row_fetch['user_phone'];
        $user_address = $row_fetch['user_address'];
    } else {
        die(mysqli_error($conn));
    }
}

if(isset($_POST['user_update'])) {
    $update_id = $user_id;
    $update_username = $_POST['username'];
    $update_phone = $_POST['user_phone'];
    $update_address = $_POST['user_address'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    if (!empty($user_image)) {
        move_uploaded_file($user_image_tmp, '../users/user_images/'. $user_image);
        
        // Update Query
        $update_query = "UPDATE users SET username = '$update_username', user_email = '$user_email', user_image = '$user_image', user_address = '$update_address', user_phone = '$update_phone' WHERE user_id = '$update_id'"; 
    } else {
        $update_query = "UPDATE users SET username = '$update_username', user_email = '$user_email',user_address = '$update_address', user_phone = '$update_phone' WHERE user_id = '$update_id'";
    }

    $update_result = mysqli_query($conn, $update_query);
    if ($update_result) {
        echo "<div class='alert'>User successfully updated.</div>";
        echo "<script>window.open('../login/logout.php', '_self');</script>";
    } else {
        die(mysqli_error($conn));
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Account</title>
</head>
<body>
    <h3 class="text-center mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline m-auto w-50 mb-4">
            <label class="form-label" for="username">Username</label>
            <input type="text" id="username" class="form-control mb-4" value="<?php echo $username;?>" name="username">
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label class="form-label" for="user_email">Ashesi Email</label>
            <input type="text" id="user_email" class="form-control mb-4" value="<?php echo $user_email;?>" name="user_email" disabled>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label class="form-label" for="user_image">Profile Picture</label>
            <input type="file" id="user_image" class="form-control mb-4" name="user_image">
            <!-- <img src="../users/user_images/<?php echo $user_image?>" alt="Profile Picture" class="profile-pic"> -->
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label class="form-label" for="user_address">Address</label>
            <input type="text" id="user_address" class="form-control mb-4" value="<?php echo $user_address;?>" name="user_address">
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label class="form-label" for="user_phone">Phone Number</label>
            <input type="text" id="user_phone" class="form-control mb-4" value="<?php echo $user_phone;?>" name="user_phone">
        </div>
        <div class="text-center">
            <input type="submit" value="Update Account" class="btn btn-custom-bg py-2 px-3" name="user_update">
        </div>
    </form>
</body>
</html>