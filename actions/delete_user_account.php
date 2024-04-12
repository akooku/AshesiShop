    <h3 class="text-center mt-2 mb-4">Delete Account</h3>
    <p class="text-center text-danger mb-4">Are you sure?</p>
    <form action="" method="POST" class="mt-5">
        <div class="form-outline mb-4 d-flex justify-content-center">
            <input type="submit" class="form-control btn btn-custom-bg w-50 m-auto" name="delete" value="Yes, delete my account">
        </div>
        <div class="form-outline mb-4 d-flex justify-content-center">
            <input type="submit" class="form-control btn btn-custom-bg-2 w-50 m-auto" name="mistake" value="No, I made a mistake!">
        </div>
    </form>

<?php
$current_user = $_SESSION['username'];
if(isset($_POST['delete'])) {
    $delete_query = "DELETE FROM users WHERE username = '$current_user'";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        session_destroy();
        echo "<script>alert('Sad to see you go :(');</script>";
        echo "<script>window.open('../index.php','_self');</script>";
    }
}

if(isset($_POST['mistake'])) {
    echo "<script>alert('You made the right decision ;)');</script>";
    echo "<script>window.open('../users/profile.php','_self');</script>";
}
?>