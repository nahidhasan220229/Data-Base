<?php
// Include database connection
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Billing</title>
</head>
<body>

<header>
    <h1>Billing</h1>
</header>

<div class="container">
    <nav>
        <a href="menu.php">View Menu</a>
        <a href="staff.php">Manage Staff</a>
    </nav>

    <!-- Select Order for Billing or Updating Status -->
    <h2>Manage Orders</h2>
    <form action="billing.php" method="post">
        <label for="order_id">Order:</label>
        <select name="order_id" required>
            <option value="" disabled selected>Select an order</option>
            <?php
            // Fetch pending orders
            $stmt = $conn->prepare("
                SELECT O.Order_ID, C.Name AS Customer_Name 
                FROM `Order` O 
                JOIN Customer C ON O.Customer_ID = C.Customer_ID 
                WHERE O.Status = 'pending'
            ");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['Order_ID']}'>Order #{$row['Order_ID']} - {$row['Customer_Name']}</option>";
            }
            $stmt->close();
            ?>
        </select>

        <label for="action">Action:</label>
        <select name="action" required>
            <option value="" disabled selected>Choose an action</option>
            <option value="generate_bill">Generate Bill</option>
            <option value="update_status">Update Status</option>
        </select>
        <p></p>
        <label for="status" id="status_label" style="display:none;">New Status:</label>
        <p></p>
        <select name="status" id="status_select" style="display:none;">
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
        </select>
        <p></p>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_id = $_POST['order_id'] ?? null;
        $action = $_POST['action'] ?? null;

        if ($order_id && $action) {
            if ($action === 'generate_bill') {
                // Generate the bill
                $stmt = $conn->prepare("
                    SELECT M.Item_Name, M.Price, OI.Quantity 
                    FROM Order_Items OI
                    JOIN Menu M ON OI.Menu_ID = M.Menu_ID
                    WHERE OI.Order_ID = ?
                ");
                $stmt->bind_param("i", $order_id);
                $stmt->execute();
                $items_result = $stmt->get_result();

                if ($items_result->num_rows > 0) {
                    $total_amount = 0;
                    echo "<h2>Bill for Order #$order_id</h2>";
                    echo "<table>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>";

                    while ($item = $items_result->fetch_assoc()) {
                        $item_total = $item['Price'] * $item['Quantity'];
                        $total_amount += $item_total;

                        echo "<tr>
                                <td>{$item['Item_Name']}</td>
                                <td>{$item['Price']}</td>
                                <td>{$item['Quantity']}</td>
                                <td>{$item_total}</td>
                              </tr>";
                    }

                    echo "<tr>
                            <td colspan='3'><strong>Grand Total</strong></td>
                            <td><strong>{$total_amount}</strong></td>
                          </tr>";
                    echo "</table>";

                    // Record the bill in the Bill table
                    $stmt = $conn->prepare("INSERT INTO Bill (Order_ID, Total_Amount) VALUES (?, ?)");
                    $stmt->bind_param("id", $order_id, $total_amount);
                    if ($stmt->execute()) {
                        echo "<p class='success'>Bill generated and recorded with Total Amount: $total_amount</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p class='error'>No items found for Order ID: $order_id</p>";
                }
            } elseif ($action === 'update_status') {
                // Update the order status
                $status = $_POST['status'] ?? 'paid';
                if ($status) {
                    $stmt = $conn->prepare("UPDATE `Order` SET Status = ? WHERE Order_ID = ?");
                    $stmt->bind_param("si", $status, $order_id);
                    if ($stmt->execute()) {
                        echo "<p class='success'>Order #$order_id status updated to $status.</p>";
                    } else {
                        echo "<p class='error'>Error updating status: " . $stmt->error . "</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p class='error'>Please select a status to update.</p>";
                }
            }
        } else {
            echo "<p class='error'>Please select an order and an action.</p>";
        }
    }

    $conn->close();
    ?>
</div>

<script>
    // Show or hide status dropdown based on selected action
    document.querySelector('select[name="action"]').addEventListener('change', function() {
        const statusLabel = document.getElementById('status_label');
        const statusSelect = document.getElementById('status_select');
        if (this.value === 'update_status') {
            statusLabel.style.display = 'inline';
            statusSelect.style.display = 'inline';
        } else {
            statusLabel.style.display = 'none';
            statusSelect.style.display = 'none';
        }
    });
</script>

</body>
</html>
