<?php
include('dbconnect.php');
session_start();

// Validate POST input
if (!isset($_POST['userid'], $_POST['pass'])) {
    header('Location: error.php?ec=0');
    exit;
}

$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$q = "SELECT * FROM usrdt WHERE usrid = '$userid' AND usrpswd = '$pass'";
$r = mysqli_query($conn, $q) or die("Error in query: <mark>$q</mark><br>" . mysqli_error($conn));

if (mysqli_num_rows($r) === 1) {
    // Check if already logged in
    if (!isset($_SESSION['UID'])) {
        $user = mysqli_fetch_assoc($r);
        $_SESSION['UID'] = $user['usrid'];
        $_SESSION['NAME'] = $user['usrname'];
        $_SESSION['TYPE'] = $user['usrtype'];
        header('Location: formToSearch.php');
        exit;
    } else {
        header('Location: error.php?ec=2'); // Already logged in
        exit;
    }
} else {
    header('Location: error.php?ec=0'); // Invalid credentials
    exit;
}
?>
