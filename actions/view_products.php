<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
    <h3 class="text-center">All Products</h3>
    <table class="custom-table table-bordered text-center mt-3">
        <thead class="custom-bg">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Sold</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $get_products = "SELECT * FROM products";
            $result_products = mysqli_query($conn, $get_products);
            $number = 0;
            
            while ($row_products = mysqli_fetch_assoc($result_products)) {
                $product_id = $row_products['product_id'];
                $product_name = $row_products['product_name'];
                $product_image = $row_products['product_image'];
                $product_price = $row_products['product_price'];
                $product_quantity = $row_products['product_quantity'];
                $product_status = $row_products['status'];
                $number++;
            ?>

            <tr>
                <td><?php echo $number; ?></td>
                <td><img src='../admin/product_images/<?php echo $product_image; ?>' class='cart-img' alt='<?php echo $product_name; ?>'></td>
                <td><?php echo $product_name; ?></td>
                <td>GHS <?php echo $product_price; ?></td>
                <td><?php echo $product_quantity; ?></td>
                <td>
                    <?php
                    $get_count = "SELECT * FROM pending WHERE product_id = $product_id";
                    $result_count = mysqli_query($conn, $get_count);
                    $rows_count = mysqli_num_rows($result_count);
                    echo $rows_count;
                    ?>
                </td>
                <td><?php echo $product_status; ?></td>
                <td><a href='index.php?edit_product=<?php echo $product_id; ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_product=<?php echo $product_id; ?>'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }?>
            
        </tbody>
    </table>
</body>
</html>