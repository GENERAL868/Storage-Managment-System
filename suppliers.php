<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // User is not logged in
    exit;
} elseif ($_SESSION['TYPE'] == 'A') {
    $pageTitle = 'New Purchase';
    include('header.php');
    include('dbconnect.php');

    // Add topLinks navigation
    echo '
    <div id="topLinks">
        <ul>
            <li><a href="formToSearch.php">Home</a></li>
            <li><a href="formItems.php">Add or Delete or Update items</a></li>

        </ul>
    </div>';

    // Create suppliers table if it doesn't exist
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

        // Ensure no empty supplierId or supplierName
        if (!empty($id) && !empty($name)) {
            $stmt = $conn->prepare("INSERT INTO suppliers (supplierId, supplierName, supplierAddress, supplierPhone, supplierEmail) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $id, $name, $address, $phone, $email);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Supplier added successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Supplier ID and Name are required!</p>";
        }
    }

    // Handle Delete Supplier
    if (isset($_POST['delete_supplier'])) {
        $id = $_POST['deleteId'];
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM suppliers WHERE supplierId = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "<p style='color:red;'>Supplier deleted successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Supplier ID is required!</p>";
        }
    }

    // Fetch Suppliers
    $result = $conn->query("SELECT * FROM suppliers ORDER BY supplierId ASC");
    ?>

    <!DOCTYPE html>
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
<form method="POST" onsubmit="return confirmDelete();">
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
