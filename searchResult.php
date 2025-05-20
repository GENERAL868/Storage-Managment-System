<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // user is not logged in
    exit;
} else {
    include('mylib.php');
    $errors = [];

    if (
        empty($_POST['nm']) &&
        empty($_POST['ic']) &&
        !isset($_POST['ct']) &&
        $_POST['pf'] == "" &&
        $_POST['pt'] == "" &&
        empty($_POST['sl']) &&
        $_POST['qf'] == "" &&
        $_POST['qt'] == "" &&
        empty($_POST['ls'])
    ) {
        $errors[] = "Please fill at least one field from searching page";
        $pageTitle = 'Error';
        include('header.php');

       

        DisplayErrors();
    } else {
        $pageTitle = 'Search Result';
        include('header.php');

        //topLinks bar
        echo '<div id="topLinks">
    <ul>
        <li><a href="formToSearch.php">Home</a></li>';
        
if ($_SESSION['TYPE'] === 'A') {
    echo '
        <li><a href="suppliers.php">Add or Delete suppliers</a></li>
        <li><a href="formItems.php">Add or Delete or Update items</a></li>';
}

echo '
    </ul>
</div>';
$pageTitle = 'Inventory Management System';
        include('dbconnect.php');

        echo "<form style='width: 90%'>\n";
        echo "<h2>The Result of Searching for Items - <a href='javascript:history.back()'>Change your search values</a></h2>\n";

        $q = "SELECT * FROM items WHERE iCode = iCode";

        echo "<i>You are searching for:<br></i>\n";

        if (!empty($_POST['nm'])) {
            echo "<b>Description (start with):</b> $mo{$_POST['nm']}$mc<br>";
            $q .= " AND iDesc LIKE '{$_POST['nm']}%'";
        }

        if (!empty($_POST['ic'])) {
            echo "<b>Item Code:</b> $mo{$_POST['ic']}$mc<br>";
            $q .= " AND iCode LIKE '%{$_POST['ic']}%'";
        }

        if (isset($_POST['ct'])) {
            echo "<b>Category(s):</b><br>";
            foreach ($_POST['ct'] as $v) {
                $p = mysqli_fetch_row(mysqli_query($conn, "SELECT categoryDesc FROM categories WHERE categoryCode = $v"));
                echo "- $mo{$p[0]}$mc<br>";
            }
            $x = implode(", ", $_POST['ct']);
            $q .= " AND iCategoryCode IN($x)";
        }

        if (!empty($_POST['sl'])) {
            echo "<b>Storage Location:</b> $mo{$_POST['sl']}$mc<br>";
            $q .= " AND iStorageLoc LIKE '%{$_POST['sl']}%'";
        }

        if ($_POST['pf'] != "" && $_POST['pt'] != "") {
            echo "<b>Price:</b> Between $mo{$_POST['pf']}$mc and $mo{$_POST['pt']}$mc<br>";
            $q .= " AND iPrice BETWEEN {$_POST['pf']} AND {$_POST['pt']}";
        } elseif ($_POST['pf'] != "") {
            echo "<b>Price:</b> more than or equal $mo{$_POST['pf']}$mc<br>";
            $q .= " AND iPrice >= {$_POST['pf']}";
        } elseif ($_POST['pt'] != "") {
            echo "<b>Price:</b> less than or equal $mo{$_POST['pt']}$mc<br>";
            $q .= " AND iPrice <= {$_POST['pt']}";
        }

        if (!empty($_POST['ls'])) {
            $p = mysqli_fetch_row(mysqli_query($conn, "SELECT supplierName FROM suppliers WHERE supplierId = {$_POST['ls']}"));
            echo "<b>Last Supplier:</b> $mo{$p[0]}$mc<br>";
            $q .= " AND iLastSupplierId = {$_POST['ls']}";
        }

        if ($_POST['qf'] != "" && $_POST['qt'] != "") {
            echo "<b>Quantity on hand:</b> Between $mo{$_POST['qf']}$mc and $mo{$_POST['qt']}$mc<br>";
            $q .= " AND iQtyOnHand BETWEEN {$_POST['qf']} AND {$_POST['qt']}";
        } elseif ($_POST['qf'] != "") {
            echo "<b>Quantity on hand:</b> more than or equal $mo{$_POST['qf']}$mc<br>";
            $q .= " AND iQtyOnHand >= {$_POST['qf']}";
        } elseif ($_POST['qt'] != "") {
            echo "<b>Quantity on hand:</b> less than or equal $mo{$_POST['qt']}$mc<br>";
            $q .= " AND iQtyOnHand <= {$_POST['qt']}";
        }

        echo "<hr>\n";

        $q .= " ORDER BY iDesc";
        $r = mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>\n" . mysqli_error($conn));

        $i = mysqli_num_rows($r);
        if ($i == 0) {
            echo "<i>There are no item(s) matching your search values</i>\n";
        } else {
            echo "<i>There are $mo $i item(s) $mc matching your search values</i>\n";

            $admin = ($_SESSION['TYPE'] == 'A') ? "<th>Actions</th>" : "";
            echo "<table>\n";
            echo "<tr><th>Item Code</th> <th>Desc & Spec</th> <th>Category</th> <th>QTY on Hand</th> <th>Price</th> <th>Cost</th> <th>Location</th> <th>Last Supplier</th> $admin</tr>\n";

            $n = 0;
            while ($item = mysqli_fetch_assoc($r)) {
                $n++;
                $desc = mysqli_fetch_row(mysqli_query($conn, "SELECT categoryDesc FROM categories WHERE categoryCode = {$item['iCategoryCode']}"));
                $supl = mysqli_fetch_row(mysqli_query($conn, "SELECT supplierName FROM suppliers WHERE supplierId = {$item['iLastSupplierId']}"));
                $code = "?x={$item['iCode']}";

                $action = "";
                $st = "";

                if ($item['iQtyOnHand'] > 0) {
                    if ($_SESSION['TYPE'] == 'A') {
                        $action = "<td><a href='formToIssueItem.php$code'>Issue this item</a> | <a href='formToPurchase.php$code'>New Purchase</a></td>";
                    }
                } else {
                    if ($_SESSION['TYPE'] == 'A') {
                        $action = "<td><a href='formToPurchase.php$code'>New Purchase</a></td>";
                    }
                    $st = "style='background-color: #ff0;'";
                }

                echo "<tr $st>
                        <td>($n) {$item['iCode']}</td>
                        <td>{$item['iDesc']}</td>
                        <td>{$desc[0]}</td>
                        <td>{$item['iQtyOnHand']}</td>
                        <td>{$item['iPrice']}</td>
                        <td>{$item['iCost']}</td>
                        <td>{$item['iStorageLoc']}</td>
                        <td>{$supl[0]}</td>
                        $action
                      </tr>\n";
            }
            echo "</table>\n";
        }
        echo "</form>\n";
    }

    include('footer.php');
}
?>
