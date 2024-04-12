<?php

if (isset($_GET['edit_product'])) {
    $edit_id = $_GET['edit_product'];
    $edit_query = "SELECT * FROM products WHERE product_id = '$edit_id'";
    $edit_result = mysqli_query($conn, $edit_query);
    $row_product = mysqli_fetch_assoc($edit_result);
    $product_name = $row_product['product_name'];
    $product_description = $row_product['product_description'];
    $product_keywords = $row_product['product_keywords'];
    $product_image = $row_product['product_image'];
    $product_price = $row_product['product_price'];
    $product_quantity = $row_product['product_quantity'];

    // Fetch Category Details
    $category_id = $row_product['category_id'];
    $category_query = "SELECT * FROM categories WHERE category_id = '$category_id'";
    $category_result = mysqli_query($conn, $category_query);
    $row_category = mysqli_fetch_assoc($category_result);
    $category_name = $row_category['category_name'];
}

?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" id="product_name" name="product_name" class="form-control mb-4" value="<?php echo $product_name; ?>" required>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description" name="product_description" class="form-control mb-4" value="<?php echo $product_description; ?>" required>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" class="form-control mb-4" value="<?php echo $product_keywords; ?>" required>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" class="form-select mb-4">
                <?php
                // Fetch Category Details
                $category_query_all = "SELECT * FROM categories";
                $category_result_all = mysqli_query($conn, $category_query_all);
                while ($row_category_all = mysqli_fetch_assoc($category_result_all)) {
                    $category_name_all = $row_category_all['category_name'];
                    $category_id_all = $row_category_all['category_id'];
                    // Check if the category matches the current product's category
                    $selected = ($category_id_all == $category_id) ? "selected" : "";
                    echo "<option value='$category_id_all' $selected>$category_name_all</option>";
                }
                ?>
            </select>
        </div>    
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_image" class="form-label">Product Image</label>
            <div class="d-flex">
                <input type="file" id="product_image" name="product_image" class="form-control m-auto" value="" required>
                <img src="../admin/product_images/<?php echo $product_image; ?>" class="w-25" alt="Product Image">
            </div>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" name="product_price" class="form-control mb-4" value="<?php echo $product_price; ?>" required>
        </div>
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_quantity" class="form-label">Product Quantity</label>
            <input type="text" id="product_quantity" name="product_quantity" class="form-control mb-4" value="<?php echo $product_quantity; ?>" required>
        </div>
        <div class="m-auto w-50 mb-4">
            <input type="submit" name="update_product" value="Save Changes" class="btn btn-custom-bg-2">
        </div>
    </form>
</div>

<!-- Edit Product Details -->
<?php

if(isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp = $_FILES['product_image']['tmp_name'];

    // Check if fields are empty
    if (empty($product_name) || empty($product_description) || empty($product_keywords) || empty($product_category) || empty($product_price) || empty($product_quantity)) {
        echo '<div class="alert alert-danger" role="alert">Please fill out all fields</div>';
    } else {
        if (!empty($product_image)) {
            move_uploaded_file($product_image_temp, '../admin/product_images/'. $product_image);
            
            // Update Query
            $update_query = "UPDATE products SET product_name = '$product_name', product_description = '$product_description', product_keywords = '$product_keywords', category_id = '$product_category', product_image = '$product_image', product_price = '$product_price', product_quantity = '$product_quantity', date = NOW() WHERE product_id = '$edit_id'"; 
        } else {
            $update_query = "UPDATE products SET product_name = '$product_name', product_description = '$product_description', product_keywords = '$product_keywords', category_id = '$product_category', product_price = '$product_price', product_quantity = '$product_quantity', date = NOW() WHERE product_id = '$edit_id'";
        }
        
        // Execute the statement
        $update_result = mysqli_query($conn, $update_query);
        if ($update_result) {
            echo '<div class="alert" role="alert">Product Updated Successfully</div>';
            echo '<script>window.open("../admin/index.php?view_products", "_self");</script>';
        } else {
            echo '<div class="alert" role="alert">Something Went Wrong</div>';
        }
    }
}

?>