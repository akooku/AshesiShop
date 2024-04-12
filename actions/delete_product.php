<?php

if(isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];

    // Delete Query
    $delete_query = "DELETE FROM products WHERE product_id = $delete_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        echo "<script>alert('Product Deleted Successfuly');</script>";
        echo "<script>window.open('../admin/index.php?view_products','_self');</script>";
    }
}

?>