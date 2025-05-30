<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // user is not logged in
    exit;
} elseif ($_SESSION['TYPE'] == 'A') {
    $pageTitle = 'Issue Item';
    include('header.php');
    include('dbconnect.php');

    echo '
    <div id="topLinks">
        <ul>
            <li><a href="formToSearch.php">Home</a></li>
            <li><a href="suppliers.php">Add or Delete suppliers</a></li>
            <li><a href="formItems.php">Add or Delete or Update items For Suppliers</a></li>
        </ul>
    </div>';


    $q = "SELECT * FROM items WHERE iCode = '{$_GET['x']}'";
    $r = mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>\n" . mysqli_error($conn));
    $item = mysqli_fetch_assoc($r);

    echo "<form action='savingIssueData.php' method='post'>\n";
    echo "<h2>Issuing the item $mo{$item['iDesc']} (Code: {$item['iCode']})$mc</h2>\n";

    echo "<input type='hidden' name='code' value='{$_GET['x']}'>";

    $st = "style='display: inline-block; width: 160px;'";
    echo "<label $st><b>Quantity On Hand:</b></label> $mo{$item['iQtyOnHand']}$mc (This is the available quantity)<p>\n";

    echo "<label $st><b>Quantity To Issue:</b></label> <input type='number' name='qi' style='width: 50px'> <i>*Must be $mo{$item['iQtyOnHand']}$mc (or less)</i><p>\n";

    echo "<label $st><b>Customer:</b></label>\n";
    echo "<select name='ci'>\n";
    $q = "SELECT * FROM customers";
    $r = mysqli_query($conn, $q);
    while ($cust = mysqli_fetch_assoc($r)) {
        echo "<option value='{$cust['customerId']}'>{$cust['customerName']}</option>\n";
    }
    echo "</select><p>\n";

    echo "<label $st><b>Issuing Date:</b></label>\n";
    echo "Day: <select name='d'>\n";
    echo "<option value=''>- Choose -</option>\n";
    for ($i = 1; $i <= 31; $i++) {
        $s = ($i == date('d')) ? "selected" : "";
        echo "<option value='$i' $s>" . sprintf('%02d', $i) . "</option>\n";
    }
    echo "</select>&ensp;\n";

    echo "Month: <select name='m'>\n";
    echo "<option value=''>- Choose -</option>\n";
    $months = [1 => "January", "February", "March", "April", "May", "June",
               "July", "August", "September", "October", "November", "December"];
    foreach ($months as $k => $v) {
        $s = ($v == date('F')) ? "selected" : "";
        echo "<option value='$k' $s>$v</option>\n";
    }
    echo "</select>&ensp;\n";

    echo "Year: <select name='y'>\n";
    echo "<option value=''>- Choose -</option>\n";
    for ($i = date('Y'); $i >= date('Y') - 50; $i--) {
        $s = ($i == date('Y')) ? "selected" : "";
        echo "<option value='$i' $s>$i</option>\n";
    }
    echo "</select><p>\n";

    echo "<label $st><b>Invoice No:</b></label> <input type='number' name='in' style='width: 100px'> <i>*Must be 1 to 10 digits</i><p>\n";

    echo "<label $st><b>Comment:</b></label> <input type='text' name='com' style='width: 400px'><p>\n";

    echo "<hr>\n";

    echo "<div class='buttons'>\n";
    echo "<input type='submit' value='Save Data'> <input type='reset' value='Clear Data'>\n";
    echo "</div>\n";
    echo "</form>\n";

    include('footer.php');
} else {
    header('Location: error.php?ec=4'); // user is not admin
    exit;
}
?>
