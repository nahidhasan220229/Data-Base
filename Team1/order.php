<?php
// Include database connection
include 'db.php';

$success_message = ''; // Initialize the success message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_order'])) {
    $customer_id = $_POST['customer_id'];
    $table_number = $_POST['table_number'];
    $menu_items = isset($_POST['menu_items']) ? $_POST['menu_items'] : [];
    $quantities = $_POST['quantities'];
    $current_datetime = date('Y-m-d H:i:s'); // Get current date and time

    if (!empty($menu_items)) {
        // Insert a new order into the Order table
        $insert_order = "INSERT INTO `Order` (Customer_ID, Table_Number, Status, Order_Date_Time) VALUES (?, ?, 'Pending', ?)";
        $stmt = $conn->prepare($insert_order);
        $stmt->bind_param('iis', $customer_id, $table_number, $current_datetime);

        if ($stmt->execute()) {
            $order_id = $stmt->insert_id; // Get the new Order ID

            foreach ($menu_items as $menu_id) {
                $quantity = isset($quantities[$menu_id]) ? $quantities[$menu_id] : 0;

                if ($quantity > 0) {
                    // Check if the item already exists in the order
                    $check_query = "SELECT * FROM Order_Items WHERE Order_ID = ? AND Menu_ID = ?";
                    $check_stmt = $conn->prepare($check_query);
                    $check_stmt->bind_param('ii', $order_id, $menu_id);
                    $check_stmt->execute();
                    $result = $check_stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Update quantity if item already exists
                        $update_query = "UPDATE Order_Items SET Quantity = Quantity + ? WHERE Order_ID = ? AND Menu_ID = ?";
                        $update_stmt = $conn->prepare($update_query);
                        $update_stmt->bind_param('iii', $quantity, $order_id, $menu_id);
                        if (!$update_stmt->execute()) {
                            echo "<p class='error'>Error updating item: " . $conn->error . "</p>";
                        }
                    } else {
                        // Insert new record if it doesn't exist
                        $insert_order_item = "INSERT INTO Order_Items (Order_ID, Menu_ID, Quantity) VALUES (?, ?, ?)";
                        $insert_stmt = $conn->prepare($insert_order_item);
                        $insert_stmt->bind_param('iii', $order_id, $menu_id, $quantity);
                        if (!$insert_stmt->execute()) {
                            echo "<p class='error'>Error adding item: " . $conn->error . "</p>";
                        }
                    }
                }
            }

            $success_message = "<p class='success'>Order created successfully! Order ID: $order_id</p>";
        } else {
            echo "<p class='error'>Error creating order: " . $conn->error . "</p>";
        }
    } else {
        echo "<p class='error'>No menu items selected. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Create Order</title>
</head>
<body>

<header>
    <h1>Create Order</h1>
</header>

<div class="container">
    <nav>
        <a href="customer.php">Sign In</a>    
        <a href="feedback.php">Give Feedback</a>
    </nav>
    <form action="order.php" method="post">
        <!-- Customer Dropdown -->
        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" required>
            <option value="" disabled selected>Select a customer</option>
            <?php
            // Fetch customers
            $result = $conn->query("SELECT Customer_ID, Name FROM Customer");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['Customer_ID']}'>{$row['Name']}</option>";
            }
            ?>
        </select>

        <!-- Table Number Field -->
        <label for="table_number">Table Number:</label>
        <input type="number" name="table_number" min="1" max="18" required placeholder="Enter table number">

        <!-- Menu Items Table -->
        <h2>Menu</h2>
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Item Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch menu items
                $menu_result = $conn->query("SELECT Menu_ID, Item_Name, Price FROM Menu WHERE Availability = 'yes'");
                if ($menu_result->num_rows > 0) {
                    while ($menu = $menu_result->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' name='menu_items[]' value='{$menu['Menu_ID']}'></td>
                                <td>{$menu['Item_Name']}</td>
                                <td>" . number_format($menu['Price'], 0) . "</td>
                                <td><input type='number' name='quantities[{$menu['Menu_ID']}]' min='1' placeholder='0'></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No menu items available</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <input type="submit" name="create_order" value="Place Order">
    </form>

    <!-- Success Message -->
    <?php if (!empty($success_message)) echo $success_message; ?>
</div>

</body>
</html>
