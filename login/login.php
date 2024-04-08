<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/product.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>
    <div class="card p-5">
        <h2 class="text-center mb-4">Login</h2>
        <div class="text-center mb-4">
            <p>Please select your role:</p>
            <div class="btn-group" role="group" aria-label="Role selection">
            <div class="card-inner border-0 pt-2 me-3">
                <a href="../users/user_login.php" class="btn btn-custom-bg">User</a>
            </div>
            <div class="card-inner border-0 pt-2">
                <a href="../business/business_login.php" class="btn btn-custom-bg">Business Owner</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
