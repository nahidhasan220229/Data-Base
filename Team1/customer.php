<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Resister</title>
</head>
<body>

<header>
    <h1>Resister</h1>
</header>

<div class="container">
    <nav>
        <a href="order.php">Create Order</a>
    </nav>

    <form action="customer.php" method="post">
        <label for="name">Customer Name:</label>
        <input type="text" name="name" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" pattern="\d{11}" maxlength="11" required title="Phone number must be exactly 11 digits.">
        <p></p>
        <input type="submit" name="add_customer" value="Sign In">
    </form>

    <?php
    if (isset($_POST['add_customer'])) {
        include 'db.php';

        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];

        // Validate phone number format
        if (!preg_match("/^\d{11}$/", $phone_number)) {
            echo "<p class='error'>Phone number must be exactly 11 digits.</p>";
        } else {
            // Check if the phone number already exists
            $stmt = $conn->prepare("SELECT * FROM Customer WHERE Phone_Number = ?");
            $stmt->bind_param("s", $phone_number);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p class='error'>The phone number is already registered. Please try another number or find your name.</p>";
            } else {
                // Insert new customer
                $stmt = $conn->prepare("INSERT INTO Customer (Name, Phone_Number) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $phone_number);
                if ($stmt->execute()) {
                    echo "<p class='success'>Customer added successfully!</p>";
                } else {
                    echo "<p class='error'>Error: " . $stmt->error . "</p>";
                }
            }

            $stmt->close();
        }

        $conn->close();
    }
    ?>
</div>

</body>
</html>
