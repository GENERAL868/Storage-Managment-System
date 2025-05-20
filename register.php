<?php
include('dbconnect.php');
session_start();

$errors = [];

$table_query = "
CREATE TABLE IF NOT EXISTS usrdt (
    usrid VARCHAR(50) PRIMARY KEY,
    usrpswd VARCHAR(255) NOT NULL,
    usrname VARCHAR(100) NOT NULL,
    usremail VARCHAR(100) NOT NULL UNIQUE,
    usrtype ENUM('A','N') NOT NULL,
    usrlastlogindate DATETIME
)";
mysqli_query($conn, $table_query) or die("Table creation error: " . mysqli_error($conn));

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usrid = trim($_POST['usrid']);
    $usrpswd = trim($_POST['usrpswd']);
    $usrname = trim($_POST['usrname']);
    $usremail = trim($_POST['usremail']);
    $usrtype = strtoupper(trim($_POST['usrtype']));

    if (strlen($usrid) < 4) {
        $errors[] = "User ID must be at least 4 characters.";
    }

    if (!preg_match('/^[A-Z][A-Za-z0-9]{4,}$/', $usrpswd)) {
        $errors[] = "Password must start with a capital letter and be at least 5 characters.";
    }

    if (!in_array($usrtype, ['A', 'N'])) {
        $errors[] = "User type must be A (Admin) or N (Normal).";
    }

    if (!filter_var($usremail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

   
    $usremail_safe = mysqli_real_escape_string($conn, $usremail);
    $email_check = mysqli_query($conn, "SELECT * FROM usrdt WHERE usremail = '$usremail_safe'");
    if (mysqli_num_rows($email_check) > 0) {
        $errors[] = "Email already exists. Please use a different one.";
    }


    $usrid_safe = mysqli_real_escape_string($conn, $usrid);
    $id_check = mysqli_query($conn, "SELECT * FROM usrdt WHERE usrid = '$usrid_safe'");
    if (mysqli_num_rows($id_check) > 0) {
        $errors[] = "User ID already exists. Please choose a different one.";
    }

   
    if (empty($errors)) {
        $usrid = mysqli_real_escape_string($conn, $usrid);
        $usrpswd = mysqli_real_escape_string($conn, $usrpswd);
        $usrname = mysqli_real_escape_string($conn, $usrname);
        $usrtype = mysqli_real_escape_string($conn, $usrtype);

        $insert = "INSERT INTO usrdt (usrid, usrpswd, usrname, usremail, usrtype, usrlastlogindate)
                   VALUES ('$usrid', '$usrpswd', '$usrname', '$usremail_safe', '$usrtype', NOW())";

        if (mysqli_query($conn, $insert)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
    }
}
$pageTitle = 'Inventory Management System';
include('header.php');
?>

<h1>User Registration</h1>

<div id="topLinks">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="forgot_password.php">FORGOT PASSWORD</a></li>
    </ul>
</div>

<?php if (!empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $e): ?>
            <li><?= ($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- Registration Form -->
<form method="POST" action="">
    <table>
        <tr>
            <td><label for="usrid">User ID:</label></td>
            <td><input type="text" name="usrid" id="usrid" value="<?= ($_POST['usrid'] ?? '') ?>" required></td>
        </tr>
        <tr>
            <td><label for="usrpswd">Password:</label></td>
            <td><input type="password" name="usrpswd" id="usrpswd" required></td>
        </tr>
        <tr>
            <td><label for="usrname">Full Name:</label></td>
            <td><input type="text" name="usrname" id="usrname" value="<?= ($_POST['usrname'] ?? '') ?>" required></td>
        </tr>
        <tr>
            <td><label for="usremail">Email:</label></td>
            <td><input type="email" name="usremail" id="usremail" value="<?= ($_POST['usremail'] ?? '') ?>" required></td>
        </tr>
        <tr>
            <td><label for="usrtype">User Type:</label></td>
            <td>
                <select name="usrtype" id="usrtype" required>
                    <option value="" disabled <?= !isset($_POST['usrtype']) ? 'selected' : '' ?>>Select type</option>
                    <option value="A" <?= (($_POST['usrtype'] ?? '') === 'A') ? 'selected' : '' ?>>Admin (A)</option>
                    <option value="N" <?= (($_POST['usrtype'] ?? '') === 'N') ? 'selected' : '' ?>>Normal (N)</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="buttons" style="text-align: center;">
                <input type="submit" value="Register">
            </td>
        </tr>
    </table>
</form>

<?php include('footer.php'); ?>
