<?php
include('../settings/connection.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Check if the content length exceeds the limit
//     $contentLength = (int)$_SERVER['CONTENT_LENGTH'];
//     $postMaxSize = (int)ini_get('post_max_size');
//     if ($contentLength > $postMaxSize) {
//         // Display an alert message
//         echo '<div class="alert">The file(s) you are trying to upload exceeds the maximum allowed size.</div>';
//         exit();
//     }
// }

if(isset($_POST['insert_product'])) {
    // Sanitize user input
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_keywords = mysqli_real_escape_string($conn, $_POST['product_keywords']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);
    $product_status = 'true';

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image tmp name
    $product_image1_tmp = $_FILES['product_image1']['tmp_name'];
    $product_image2_tmp = $_FILES['product_image2']['tmp_name'];
    $product_image3_tmp = $_FILES['product_image3']['tmp_name'];

    // Check empty condition
    if(empty($product_name) || empty($product_description) || empty($product_keywords) || empty($product_category) || empty($product_price) || empty($product_quantity) || empty($product_image1)) {
        echo '<div class="alert">Please fill all the fields.</div>';
        exit();
    } else {
        // Store image
        if(!empty($product_image1)) {
            move_uploaded_file($product_image1_tmp, '../admin/product_images/' . $product_image1);
        }
        if(!empty($product_image2)) {
            move_uploaded_file($product_image2_tmp, '../admin/product_images/' . $product_image2);
        }
        if(!empty($product_image3)) {
            move_uploaded_file($product_image3_tmp, '../admin/product_images/' . $product_image3);
        }        

        // Insert product
        $insert_product = "INSERT INTO products (product_name, product_description, product_keywords, category_id, product_image1, product_image2, product_image3, product_price, product_quantity, date, status) VALUES ('$product_name','$product_description','$product_keywords','$product_category','$product_image1','$product_image2','$product_image3','$product_price',$product_quantity,NOW(),'$product_status')";

        // Execute the statement
        if(mysqli_query($conn, $insert_product)) {
            echo '<div class="alert">Product successfully added.</div>';
        } else {
            // Handle the error
            echo '<div class="alert">Something went wrong. Please try again later.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products Page</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
    <link rel="stylesheet" href="../assets/styles/admin.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert a Product</h1>
        <!-- Product Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Product Title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" id="product_name" placeholder="Enter product name" class="form-control mb-4" name="product_name" autocomplete="off" required>
            </div>

            <!-- Product Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_description">Product Description</label>
                <input type="text" id="product_description" placeholder="Enter product description" class="form-control mb-4" name="product_description" autocomplete="off" required>
            </div>

             <!-- Product Keywords -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_keywords">Product Keywords</label>
                <input type="text" id="product_keywords" placeholder="e.g. beauty, kit, skincare" class="form-control mb-4" name="product_keywords" autocomplete="off" required>
            </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label" for="product_category">Product Category</label>
                <select name="product_category" id="" class="form-select mb-4">
                    <option value="">Select a Category</option>
                    <?php
                    
                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_name = $row['category_name'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_name</option>";
                    }            
                    ?>
                </select>
            </div>

            <!-- Product Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_image1">Product Image 1</label>
                <input type="file" id="product_image1" class="form-control mb-4" name="product_image1" required>
            </div>

            <!-- Product Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_image2">Product Image 2</label>
                <input type="file" id="product_image2" class="form-control mb-4" name="product_image2">
            </div>

            <!-- Product Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_image3">Product Image 3</label>
                <input type="file" id="product_image3" class="form-control mb-4" name="product_image3">
            </div>

            <!-- Product Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_price">Product Price</label>
                <input type="text" id="product_price" placeholder="Enter product price (GHS)" class="form-control mb-4" name="product_price" autocomplete="off" required>
            </div>

            <!-- Product Quantity -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label" for="product_quantity">Product Quantity</label>
                <input type="text" id="product_quantity" placeholder="Enter product quantity" class="form-control mb-4" name="product_quantity" autocomplete="off" required>
            </div>

            <!-- Submit Button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" class="btn btn-custom-bg mb-4 px-3" name="insert_product" value="Insert product">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JS -->
    <script src="../assets/scripts/alert.js"></script>
</body>
</html>