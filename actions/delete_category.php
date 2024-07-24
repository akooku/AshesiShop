<?php

if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];
    
    // Delete Query
    $delete_query = "DELETE FROM categories WHERE category_id = $delete_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        echo "<script>alert('Category Deleted Successfuly');</script>";
        echo "<script>window.open('../admin/index.php?view_categories','_self');</script>";
    }
}

?>