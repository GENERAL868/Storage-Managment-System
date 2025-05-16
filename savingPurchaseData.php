<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); //user is not logged in
    exit;
} elseif ($_SESSION['TYPE'] == 'A'){
    include('mylib.php');
    include('dbconnect.php');

    $q = "select * from items where iCode = '{$_POST['code']}'";
    $r = mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>\n". mysqli_error($conn));
    $item = mysqli_fetch_assoc($r);

    $errors = [];
    if (!preg_match("/^[0-9]{1,3}$/", $_POST['qp'])) {$errors[] = "Correct the quantity to purchase";}
    if (empty($_POST['d']) || empty($_POST['m']) || empty($_POST['y'])) {
        $errors[] = "Select every date detail";
    } else {
        $ids = mktime(0, 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
        $tds = time();
        if (!checkdate($_POST['m'], $_POST['d'], $_POST['y']) || $ids > $tds) {
            $errors[] = "Select valid date or select date before current date";
        }
    }
    if (!preg_match("/^[0-9]{1,6}$/", $_POST['pn'])) {$errors[] = "Correct the purchase order number";}
    if (!empty($_POST['com'])) {
        if (!preg_match("/^[a-zA-Z0-9\,\-\/\s\.]{1,50}$/", $_POST['com'])) {$errors[] = "Correct the comment";}
    }

    if (count($errors) == 0) {
        $pageTitle = 'Purchased';

        $purchDate = date("Y-m-d", mktime(0,0,0,$_POST['m'],$_POST['d'],$_POST['y']));
        $currentDate = date("Y-m-d");

        $q = "insert into purchases (purchItemCode, purchSuppId, purchQty, purchDate, purchOrderNo, purchComment, purchDateTime)
        values('{$_POST['code']}', {$_POST['si']}, {$_POST['qp']}, '$purchDate', {$_POST['pn']}, '{$_POST['com']}', '$currentDate')";
        mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>\n". mysqli_error($conn));
        
        $newQtyOnHand = $item['iQtyOnHand'] + $_POST['qp'];

        $q = "update items set iQtyOnHand = $newQtyOnHand, iDateLastPurchased = '$currentDate', iLastSupplierId = {$_POST['si']} where iCode = '{$_POST['code']}'";
        mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>\n". mysqli_error($conn));

        header('Location: formToSearch.php');
    } else {
        $pageTitle = 'Error';
        include('header.php');
        DisplayErrors();
        include('footer.php');
    }
} else {
    header('Location: error.php?ec=4'); //user is not admin
    exit;
}
?>