<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // User not logged in
    exit;
} elseif ($_SESSION['TYPE'] == 'A') {
    $pageTitle = 'Items Management';
    include('header.php');
    include('dbconnect.php');

    echo '
    <div id="topLinks">
        <ul>
            <li><a href="formToSearch.php">Home</a></li>
            <li><a href="suppliers.php">Add or Delete suppliers</a></li>
            <li><a href="user.php">UPDATE USER</a></li>
        </ul>
    </div>';

    // Create items table if it doesn't exist
    $create_items_table = "
    CREATE TABLE IF NOT EXISTS items (
        iCode CHAR(8) PRIMARY KEY,
        iCategoryCode INT NOT NULL,
        iDesc CHAR(50),
        iSpec CHAR(50),
        iQtyOnHand INT DEFAULT 0,
        iStorageLoc CHAR(50),
        iCost DOUBLE,
        iPrice DOUBLE DEFAULT 0,
        iLastSupplierId INT,
        iStatus CHAR(1),
        iLastCustomerId INT,
        iQtyLastPurchased INT,
        iQtyLastIssued INT,
        iDateLastIssued DATE,
        iDateLastPurchased DATE
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    $conn->query($create_items_table);

    // Handle Add/Update Item
    if (isset($_POST['save_item'])) {
        $stmt = $conn->prepare("REPLACE INTO items (iCode, iCategoryCode, iDesc, iSpec, iQtyOnHand, iStorageLoc, iCost, iPrice, iLastSupplierId, iStatus, iLastCustomerId, iQtyLastPurchased, iQtyLastIssued, iDateLastIssued, iDateLastPurchased)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissisddisiiiss",
            $_POST['iCode'], $_POST['iCategoryCode'], $_POST['iDesc'], $_POST['iSpec'], $_POST['iQtyOnHand'], $_POST['iStorageLoc'],
            $_POST['iCost'], $_POST['iPrice'], $_POST['iLastSupplierId'], $_POST['iStatus'], $_POST['iLastCustomerId'],
            $_POST['iQtyLastPurchased'], $_POST['iQtyLastIssued'], $_POST['iDateLastIssued'], $_POST['iDateLastPurchased']
        );
        $stmt->execute();
        echo "<p style='color:green;'>Item saved successfully!</p>";
    }

    // Handle Delete Item
    if (isset($_POST['delete_item'])) {
        $code = $_POST['iCode'];
        if (!empty($code)) {
            $stmt = $conn->prepare("DELETE FROM items WHERE iCode = ?");
            $stmt->bind_param("s", $code);
            $stmt->execute();
            echo "<p style='color:red;'>Item deleted successfully!</p>";
        }
    }

    // Fetch Items
    $items = $conn->query("SELECT * FROM items ORDER BY iCode ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Management</title>
    <link rel="stylesheet" href="styles/items_management.css">
</head>
<body>

<h1>Item Management</h1>

<form method="POST" class="form-container">
    <h2>Add / Update Item</h2>
    <table class="form-table">
        <tr>
            <td><label for="iCode">Item Code:</label></td>
            <td><input type="text" name="iCode" id="iCode" required></td>
        </tr>

        <tr>
            <td><label for="iCategoryCode">Category Code:</label></td>
            <td>
                <select name="iCategoryCode" id="iCategoryCode" required>
                    <option value="">Select Category</option>
                    <?php
                    $cat_result = $conn->query("SELECT categoryCode, categoryDesc FROM categories");
                    while ($cat = $cat_result->fetch_assoc()) {
                        echo "<option value='{$cat['categoryCode']}'>{$cat['categoryCode']} - {$cat['categoryDesc']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td><label for="iDesc">Description:</label></td>
            <td><input type="text" name="iDesc" id="iDesc"></td>
        </tr>

        <tr>
            <td><label for="iSpec">Specification:</label></td>
            <td><input type="text" name="iSpec" id="iSpec"></td>
        </tr>

        <tr>
            <td><label for="iQtyOnHand">Qty On Hand:</label></td>
            <td><input type="number" name="iQtyOnHand" id="iQtyOnHand"></td>
        </tr>

        <tr>
            <td><label for="iStorageLoc">Storage Location:</label></td>
            <td><input type="text" name="iStorageLoc" id="iStorageLoc"></td>
        </tr>

        <tr>
            <td><label for="iCost">Cost:</label></td>
            <td><input type="number" step="0.01" name="iCost" id="iCost"></td>
        </tr>

        <tr>
            <td><label for="iPrice">Price:</label></td>
            <td><input type="number" step="0.01" name="iPrice" id="iPrice"></td>
        </tr>

        <tr>
            <td><label for="iLastSupplierId">Last Supplier ID:</label></td>
            <td>
                <select name="iLastSupplierId" id="iLastSupplierId">
                    <option value="">Select Supplier</option>
                    <?php
                    $sup_result = $conn->query("SELECT supplierId, supplierName FROM suppliers");
                    while ($sup = $sup_result->fetch_assoc()) {
                        echo "<option value='{$sup['supplierId']}'>{$sup['supplierId']} - {$sup['supplierName']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td><label for="iStatus">Status:</label></td>
            <td>
                <select name="iStatus" id="iStatus">
                    <option value="A">A - Admin</option>
                    <option value="N">N - Normal</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="center">
                <button type="submit" name="save_item">Save Item</button>
            </td>
        </tr>
    </table>
</form>

<form method="POST" onsubmit="return confirmDelete()" class="form-container delete-form">
    <h2>Delete Item</h2>
    <table class="form-table">
        <tr>
            <td><label for="delete_iCode">Item Code:</label></td>
            <td><input type="text" name="iCode" id="delete_iCode" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center">
                <button type="submit" name="delete_item" class="delete-btn">Delete Item</button>
            </td>
        </tr>
    </table>
</form>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}
</script>

<!-- Items Table -->
<h2>Items List</h2>
<div class="table-container">
    <table class="items-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Category</th>
                <th>Description</th>
                <th>Spec</th>
                <th>Qty</th>
                <th>Storage</th>
                <th>Cost</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Qty Purchased</th>
                <th>Qty Issued</th>
                <th>Last Issued</th>
                <th>Last Purchased</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $items->fetch_assoc()) { ?>
            <tr>
                <?php foreach ($row as $value) echo '<td>' . ($value) . '</td>'; ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
    include('footer.php');
} else {
    header('Location: error.php?ec=4'); // Not admin
    exit;
}
?>
