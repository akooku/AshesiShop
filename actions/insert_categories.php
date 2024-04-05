<?php
include('../settings/connection.php');

if(isset($_POST['insert_cat'])) {
    // Sanitize user input
    $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    // Select data from database
    $select_query = "SELECT * FROM categories where category_name = '$category_name'";
    $select_result = mysqli_query($conn, $select_query);

    // Check if category already exists
    if(mysqli_num_rows($select_result) > 0) {
        echo '<div class="alert">Category already exists!</div>';
    } else {
        // Prepare the SQL statement
        $insert_query = "INSERT INTO categories (category_name) VALUES (?)";
        
        // Bind parameters and execute the prepared statement
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "s", $category_name);
        
        // Execute the statement
        if(mysqli_stmt_execute($stmt)) {
            echo '<div class="alert">Category successfully added.</div>';
        } else {
            // Handle the error
            echo "Error: " . mysqli_error($conn);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    }
}
?>

<h2 class="text-center">Insert a Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text custom-bg" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_name" placeholder="Insert Category" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="btn btn-custom-bg-2 border-0 px-3 my-3" name="insert_cat" value="Insert Category">
    </div>
</form>