<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>
    
</head>
<body>
    <?php
    
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM users WHERE username = '$username'";
    $run_user = mysqli_query($conn, $get_user);
    $row_user = mysqli_fetch_assoc($run_user);
    $user_id = $row_user['user_id'];
    
    ?>
    <h3 class="text-center">All My Orders</h3>
    <table class="custom-table table-bordered text-center mt-5">
        <thead class="custom-bg">
            <tr>
                <th>S/N</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // Fetch User's Orders
            $get_orders = "SELECT * FROM orders WHERE user_id = '$user_id'";
            $run_orders = mysqli_query($conn, $get_orders);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($run_orders)) {
                $order_id = $row_orders['order_id'];
                $invoice_number = $row_orders['invoice_number'];
                $total_products = $row_orders['total_products'];
                $amount_due = $row_orders['amount_due'];
                $date = $row_orders['order_date'];
                $status = $row_orders['order_status'];
                if ($status == 'pending') {
                    $status = 'Incomplete';
                } else {
                    $status = 'Complete';
                }

                echo "
                <tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$date</td>
                    <td>$status</td>";
                    ?>
                    <?php
                    if($status == 'Complete') {
                        echo "<td><span class='btn btn-paid'>Paid</span></td>";
                    } else {
                    echo "<td><a href='../actions/confirm_payment.php?order_id=$order_id' class='btn btn-custom-bg'>Confirm</a></td>
                </tr>";
                    }
                $number++;
            }
            
            ?>
        </tbody>
    </table>
</body>
</html>