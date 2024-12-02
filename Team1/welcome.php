<?php
// Start session if needed
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Welcome - KU Cafeteria</title>
</head>
<body>

<header>
    <h1>KU Cafeteria Management System</h1>
</header>

<div class="container">
    <h2>Welcome! How can we assist you today?</h2>
    <div class="navigation">
        <a href="customer.php" class="nav-button">Resister</a>
        <a href="order.php" class="nav-button">Order</a>
        <a href="about_us.php" class="nav-button about-button">About Us</a>
    </div>
</div>
<p>/<p><p>/<p><p>/<p><p>/<p><p>/<p><p>/<p><p>/<p><p>/<p>

<footer>
    <p>© <?php echo date("Y"); ?> KU Cafeteria. All Rights Reserved.</p>
</footer>

</body>
</html>
