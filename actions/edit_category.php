<?php

if (isset($_GET['edit_category'])) {
    $edit_cat = $_GET['edit_category'];
    $edit_query = "SELECT * FROM categories WHERE category_id = '$edit_cat'";
    $edit_result = mysqli_query($conn, $edit_query);
    $row_category = mysqli_fetch_assoc($edit_result);
    $category_name = $row_category['category_name'];
}

if (isset($_POST['edit_cat'])) {
    $cat_name = $_POST['cat_name'];
    $edit_query = "UPDATE categories SET category_name = '$cat_name' WHERE category_id = '$edit_cat'";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($edit_result) {
        echo '<script>alert("Category Updated Successfully");</script>';
        echo '<script>window.open("../admin/index.php?view_categories", "_self");</script>';
    } else {
        echo '<div class="alert" role="alert">Something Went Wrong</div>';
        echo mysqli_error($conn);
    }
}

?>

<div class="container mt-3">
    <h2 class="text-center">Edit Category</h2>
    <form action="" method="post" class="mb-2">
        <div class="input-group w-50 m-auto mb-2">
            <span class="input-group-text custom-bg" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
            <input type="text" class="form-control" name="cat_name" value="<?php echo $category_name; ?>" id="cat_name" required>
        </div>
        <div class="input-group w-50 mb-2 m-auto">
            <input type="submit" class="btn btn-custom-bg-2 border-0 px-3 my-3" name="edit_cat" value="Edit Category">
        </div>
    </form>
</div>