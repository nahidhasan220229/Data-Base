<!-- staff.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Staff Management</title>
</head>
<body>

<header>
    <h1>Staff Management</h1>
</header>

<div class="container">
    <nav>
        <a href="menu.php">View Menu</a>
        <a href="billing.php">Billing</a>
    </nav>

    <!-- Add Staff Form -->
    <h2>Add New Staff Member</h2>
    <form action="staff.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="role">Role:</label>
        <input type="text" name="role" required>

        <label for="availability">Availability:</label>
        <select name="availability" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <label for="salary">Salary:</label>
        <input type="number" name="salary" step="0.01" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" pattern="\d{11}" maxlength="11" required title="Phone number must be exactly 11 digits.">

        <p></p>
        <input type="submit" name="add_staff" value="Add Staff Member">
    </form>

    <?php
    // Include database connection
    include 'db.php';

    // Handle form submission to add new staff
    if (isset($_POST['add_staff'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $availability = $_POST['availability'];
        $salary = $_POST['salary'];
        $phone_number = $_POST['phone_number'];

        // Server-side validation for the phone number
        if (!preg_match("/^\d{11}$/", $phone_number)) {
            echo "<p class='error'>Phone number must be exactly 11 digits.</p>";
        } else {
            // Check if the phone number already exists
            $check_query = "SELECT * FROM Staff WHERE Phone_Number = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("s", $phone_number);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Phone number already exists
                echo "<p class='error'>Staff is already assigned!</p>";
            } else {
                // Insert the staff member into the Staff table
                $insert_query = "INSERT INTO Staff (Name, Role, Availability, Salary, Phone_Number) 
                                 VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("sssds", $name, $role, $availability, $salary, $phone_number);

                if ($stmt->execute()) {
                    echo "<p class='success'>Staff member added successfully!</p>";
                } else {
                    echo "<p class='error'>Error: " . $stmt->error . "</p>";
                }
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <!-- Display Current Staff -->
    <h2>Current Staff Members</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Availability</th>
            <th>Salary</th>
            <th>Phone Number</th>
        </tr>
        <?php
        // Include database connection again to fetch staff
        include 'db.php';

        // Fetch and display all staff members
        $result = $conn->query("SELECT * FROM Staff");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Name']}</td>
                        <td>{$row['Role']}</td>
                        <td>{$row['Availability']}</td>
                        <td>{$row['Salary']}</td>
                        <td>{$row['Phone_Number']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No staff members found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
