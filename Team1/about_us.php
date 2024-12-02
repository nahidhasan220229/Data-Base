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
    <title>About Us - KU Cafeteria</title>
</head>
<body>

<header>
    <h1>About KU Cafeteria</h1>
</header>

<div class="container">
    <div class="about-section">
        <h2>Welcome to KU Cafeteria</h2>
        <p>
            At KU Cafeteria, we take pride in providing a variety of delicious and nutritious meals 
            to our customers. Our mission is to serve high-quality food that satisfies your taste buds 
            and ensures your well-being.
        </p>
        <p>
            With a dedicated staff and a modern management system, we ensure a seamless dining 
            experience. Explore our menu, place your orders, and enjoy a pleasant meal at KU Cafeteria!
        </p>
        <p>
            <strong>Location:</strong> KU Campus, Khulna University<br>
            <strong>Contact:</strong> 01311348672
        </p>
    </div>
    <a href="welcome.php" class="nav-button">Back to Welcome Page</a>
</div>
<p>/<p><p>/<p>

<footer>
    <p>© <?php echo date("Y"); ?> KU Cafeteria. All Rights Reserved.</p>
</footer>

</body>
</html>
