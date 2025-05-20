<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // User is not logged in
    exit;
} elseif ($_SESSION['TYPE'] == 'A') {
    $pageTitle = 'Inventory Management System';
    include('header.php');
    include('dbconnect.php');

   
    echo '
    <div id="topLinks">
        <ul>
            <li><a href="formToSearch.php">Home</a></li>
            <li><a href="formItems.php">Add or Delete or Update items</a></li>
            <li><a href="user.php">UPDATE USER</a></li>

        </ul>
    </div>';


    $create_table_query = "
    CREATE TABLE IF NOT EXISTS suppliers (
        supplierId INT PRIMARY KEY,
        supplierName VARCHAR(100) NOT NULL,
        supplierAddress TEXT,
        supplierPhone VARCHAR(50),
        supplierEmail VARCHAR(100)
    )";
    if (!$conn->query($create_table_query)) {
        echo "Error creating table: " . $conn->error;
    }

    // Handle Add Supplier
    if (isset($_POST['add_supplier'])) {
        $id      = $_POST['supplierId'];
        $name    = $_POST['supplierName'];
        $address = $_POST['supplierAddress'];
        $phone   = $_POST['supplierPhone'];
        $email   = $_POST['supplierEmail'];

        
        if (!empty($id) && !empty($name)) {
            // Check if supplierId already exists
            $check_query = "SELECT * FROM suppliers WHERE supplierId = $id";
            $result = $conn->query($check_query);

            if ($result->num_rows > 0) {
                echo "<p style='color:red;'>Supplier ID already exists. Please choose a different Supplier ID.</p>";
            } else {
                // Insert the new supplier if ID does not exist
                $insert_query = "INSERT INTO suppliers (supplierId, supplierName, supplierAddress, supplierPhone, supplierEmail) 
                                 VALUES ('$id', '$name', '$address', '$phone', '$email')";
                if ($conn->query($insert_query)) {
                    echo "<p style='color:green;'>Supplier added successfully!</p>";
                } else {
                    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
                }
            }
        } else {
            echo "<p style='color:red;'>Supplier ID and Name are required!</p>";
        }
    }

    // Handle Delete Supplier
    if (isset($_POST['delete_supplier'])) {
        $id = $_POST['deleteId'];
        if (!empty($id)) {
            $delete_query = "DELETE FROM suppliers WHERE supplierId = $id";
            if ($conn->query($delete_query)) {
                echo "<p style='color:red;'>Supplier deleted successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Supplier ID is required!</p>";
        }
    }

    // Fetch Suppliers
    $result = $conn->query("SELECT * FROM suppliers ORDER BY supplierId ASC");
    ?>

    <html>
    <head>
        <title>Suppliers Management</title>
        <style>
            body { font-family: Arial; }
            table, th, td { border: 1px solid #000; border-collapse: collapse; padding: 6px; }
            form { margin-bottom: 30px; }
            label { display: block; margin-top: 10px; }
            input, textarea { width: 300px; padding: 5px; }
            h2 { margin-top: 40px; }
        </style>
    </head>
    <body>

        <h1>Supplier Management</h1>

        <!-- Add Supplier Form -->
        <h2>Add Supplier</h2>
        <form method="POST">
            <label>Supplier ID:</label>
            <input type="number" name="supplierId" required>

            <label>Supplier Name:</label>
            <input type="text" name="supplierName" required>

            <label>Address:</label>
            <textarea name="supplierAddress"></textarea>

            <label>Phone:</label>
            <input type="text" name="supplierPhone">

            <label>Email:</label>
            <input type="email" name="supplierEmail">

            <button type="submit" name="add_supplier">Add Supplier</button>
        </form>

        <!-- Delete Supplier Form -->
<h2>Delete Supplier</h2>
<form method="POST" onsubmit="return confirmDelete()">
    <label>Enter Supplier ID to Delete:</label>
    <input type="number" name="deleteId" required>
    <div style="text-align: center;">
        <div><br></br></div>
        <button type="submit" name="delete_supplier">Delete Supplier</button>
    </div>
</form>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this supplier?");
}
</script>


        <!-- Display Suppliers Table -->
        <h2>Current Suppliers</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($B = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= ($B['supplierId']) ?></td>
                    <td><?= ($B['supplierName']) ?></td>
                    <td><?= ($B['supplierAddress']) ?></td>
                    <td><?= ($B['supplierPhone']) ?></td>
                    <td><?= ($B['supplierEmail']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </body>
    </html>

    <?php include('footer.php'); ?>

<?php 
} else {
    header('Location: error.php?ec=4'); // User is not an admin
    exit;
}
?>
