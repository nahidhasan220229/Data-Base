<!-- menu.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Menu Management</title>
</head>
<body>

<header>
    <h1>Menu Management</h1>
</header>

<div class="container">
    <nav>
        <a href="staff.php">Manage Staff</a>
        <a href="billing.php">Billing</a>
    </nav>

    <h2>Add Menu Item</h2>

    <form action="menu.php" method="post">
        <label for="category">Category:</label>
        <input type="text" name="category" required>

        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required>

        <label for="availability">Availability:</label>
        <select name="availability" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>

        <input type="submit" name="add_menu_item" value="Add Item">
    </form>

    <?php
    if (isset($_POST['add_menu_item'])) {
        include 'db.php';
        $category = $_POST['category'];
        $item_name = $_POST['item_name'];
        $availability = $_POST['availability'];
        $price = $_POST['price'];

        // Check if the item already exists
        $check_query = "SELECT * FROM Menu WHERE Item_Name = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("s", $item_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Item already exists
            echo "<p class='error'>Item is already present in the menu!</p>";
        } else {
            // Insert the new item
            $insert_query = "INSERT INTO Menu (Category, Item_Name, Availability, Price) 
                             VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sssd", $category, $item_name, $availability, $price);

            if ($stmt->execute()) {
                echo "<p class='success'>Menu item added successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . $stmt->error . "</p>";
            }
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <h2>Current Menu</h2>
    <table>
        <tr>
            <th>Category</th>
            <th>Item Name</th>
            <th>Availability</th>
            <th>Price</th>
        </tr>
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM Menu");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Category']}</td>
                        <td>{$row['Item_Name']}</td>
                        <td>{$row['Availability']}</td>
                        <td>{$row['Price']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No items found in the menu.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
