<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1');
    exit;
} elseif ($_SESSION['TYPE'] != 'A') {
    header('Location: error.php?ec=4');
    exit;
}
$pageTitle = 'Inventory Management System';
include('dbconnect.php');
include('header.php');

echo '
    <div id="topLinks">
        <ul>
            <li><a href="formToSearch.php">Home</a></li>
            <li><a href="suppliers.php">Add or Delete suppliers</a></li>
            <li><a href="formItems.php">Add or Delete or Update items</a></li>
            

        </ul>
    </div>';

// Update user data
if (isset($_POST['update_user'])) {
    $id = $_POST['usrid'];
    $name = $_POST['usrname'];
    $email = $_POST['usremail'];
    $type = $_POST['usrtype'];

    $q = "UPDATE usrdt SET usrname='$name', usremail='$email', usrtype='$type' WHERE usrid='$id'";
    if ($conn->query($q)) {
        echo "<p style='color:green;'>User updated</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Delete user
if (isset($_POST['delete_user'])) {
    $id = $_POST['usrid'];
    $conn->query("DELETE FROM usrdt WHERE usrid='$id'");
    echo "<p style='color:red;'>User deleted</p>";
}

// Get all users
$result = $conn->query("SELECT * FROM usrdt ORDER BY usrid ASC");
?>

<html>
<head>
    <title>Users Management</title>
    <style>
        body { font-family: Arial; }
        table, th, td { border: 1px solid #000; border-collapse: collapse; padding: 6px; }
        input, select { width: 160px; padding: 4px; }
        form { margin: 0; }
        button { padding: 5px 10px; }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</head>
<body>

<h2>Users List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Last Login</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

<?php
while ($B = $result->fetch_assoc()) {
    echo '<tr>';

    echo '<form method="POST">';
    echo '<td><input type="text" name="usrid" value="' . $B['usrid'] . '" readonly></td>';
    echo '<td><input type="text" name="usrname" value="' . $B['usrname'] . '"></td>';
    echo '<td><input type="email" name="usremail" value="' . $B['usremail'] . '"></td>';
    echo '<td>
            <select name="usrtype">
                <option value="A"' . ($B['usrtype'] == 'A' ? ' selected' : '') . '>A</option>
                <option value="N"' . ($B['usrtype'] == 'N' ? ' selected' : '') . '>N</option>
            </select>
          </td>';
    echo '<td>' . $B['usrlastlogindate'] . '</td>';
    echo '<td><button type="submit" name="update_user">Update</button></td>';
    echo '</form>';

    echo '<form method="POST" onsubmit="return confirmDelete();">';
    echo '<input type="hidden" name="usrid" value="' . $B['usrid'] . '">';
    echo '<td><button type="submit" name="delete_user" style="color:red;">Delete</button></td>';
    echo '</form>';

    echo '</tr>';
}
?>

</table>

</body>
</html>

<?php include('footer.php'); ?>
