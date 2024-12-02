<?php
// Include database connection
include 'db.php';

$success_message = ''; // Initialize the success message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    // Retrieve order ID and feedback
    $order_id = $_POST['order_id'];
    $feedback = $_POST['feedback'];

    // Update the feedback column in the Order table
    $query = "UPDATE `Order` SET Feedback = ? WHERE Order_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $feedback, $order_id);

    if ($stmt->execute()) {
        $success_message = "<p class='success'>Feedback submitted successfully for Order ID: $order_id</p>";
    } else {
        $success_message = "<p class='error'>Error updating feedback: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Submit Feedback</title>
</head>
<body>

<header>
    <h1>Submit Feedback</h1>
</header>

<div class="container">
    <nav>
        <a href="order.php">Create Order</a>    
    </nav>
    <form action="feedback.php" method="post">
        <!-- Order Selection -->
        <label for="order_id">Select Order:</label>
        <select name="order_id" required>
            <option value="" disabled selected>Select an order</option>
            <?php
            include 'db.php';
            // Fetch all orders without feedback
            $query = "SELECT o.Order_ID, c.Name AS Customer_Name 
                      FROM `Order` o 
                      INNER JOIN `Customer` c ON o.Customer_ID = c.Customer_ID
                      WHERE o.Feedback IS NULL OR o.Feedback = ''";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                // Escape output to prevent XSS
                $order_id = htmlspecialchars($row['Order_ID']);
                $customer_name = htmlspecialchars($row['Customer_Name']);
                echo "<option value='$order_id'>Order ID: $order_id (Customer: $customer_name)</option>";
            }
            ?>
        </select>
        <p></p>
        <!-- Feedback Input -->
        <label for="feedback">Your Feedback:</label>
        <textarea name="feedback" rows="4" placeholder="Enter your feedback here" required></textarea>
        <p></p>
        <input type="submit" name="submit_feedback" value="Submit Feedback">
    </form>

    <!-- Success Message -->
    <?php if (!empty($success_message)) echo $success_message; ?>
</div>

</body>
</html>
