<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1');
    exit;
} elseif ($_SESSION['TYPE'] == 'A') {
    include('header.php');
    include('dbconnect.php');

    // Create purchases table if not exists
    $create_purchases = "
    CREATE TABLE IF NOT EXISTS purchases (
        purchSeq INT AUTO_INCREMENT PRIMARY KEY,
        purchItemCode CHAR(8) NOT NULL,
        purchSuppID INT NOT NULL,
        purchQty INT NOT NULL,
        purchOrderNo VARCHAR(20),
        purchOrderDate DATE,
        purchDate DATE,
        purchItemCost DOUBLE,
        purchComment TEXT,
        purchDateTime DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($create_purchases);

    // Handle form submission
    if (isset($_POST['submit_purchase'])) {
        $itemCode = $_POST['itemCode'];
        $supplierId = $_POST['supplierId'];
        $qty = $_POST['quantity'];
        $orderNo = $_POST['orderNo'];
        $orderDate = $_POST['orderDate'];
        $purchDate = $_POST['purchaseDate'];
        $cost = $_POST['cost'];
        $comment = $_POST['comment'];

        $stmt = $conn->prepare("INSERT INTO purchases (purchItemCode, purchSuppID, purchQty, purchOrderNo, purchOrderDate, purchDate, purchItemCost, purchComment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisssds", $itemCode, $supplierId, $qty, $orderNo, $orderDate, $purchDate, $cost, $comment);
        $stmt->execute();

        echo "<p style='color:green;'>Purchase recorded successfully.</p>";
    }

    // Fetch suppliers and items
    $suppliers = $conn->query("SELECT supplierId, supplierName FROM suppliers");
    $items = $conn->query("SELECT iCode, iDesc FROM items");
?>

<h2>Purchase Items</h2>
<form method="POST">
    <label>Supplier:</label><br>
    <select name="supplierId" required>
        <option value="">-- Select Supplier --</option>
        <?php while ($sup = $suppliers->fetch_assoc()) { ?>
            <option value="<?= $sup['supplierId'] ?>"><?= $sup['supplierName'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Item:</label><br>
    <select name="itemCode" required>
        <option value="">-- Select Item --</option>
        <?php while ($item = $items->fetch_assoc()) { ?>
            <option value="<?= $item['iCode'] ?>"><?= $item['iCode'] ?> - <?= $item['iDesc'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" required><br><br>

    <label>Order Number:</label><br>
    <input type="text" name="orderNo"><br><br>

    <label>Order Date:</label><br>
    <input type="date" name="orderDate"><br><br>

    <label>Purchase Date:</label><br>
    <input type="date" name="purchaseDate" required><br><br>

    <label>Cost per Item:</label><br>
    <input type="number" step="0.01" name="cost" required><br><br>

    <label>Comment:</label><br>
    <textarea name="comment"></textarea><br><br>

    <button type="submit" name="submit_purchase">Submit Purchase</button>
</form>

<?php
    include('footer.php');
} else {
    header('Location: error.php?ec=4');
    exit;
}
?>
