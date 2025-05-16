<?php
include('dbconnect.php');

session_start();

$errors = [];

// Create table if not exists
$table_query = "
CREATE TABLE IF NOT EXISTS usrdt (
    usrid VARCHAR(50) PRIMARY KEY,
    usrpswd VARCHAR(255) NOT NULL,
    usrname VARCHAR(100) NOT NULL,
    usremail VARCHAR(100) NOT NULL,
    usrtype ENUM('A','N') NOT NULL,
    usrlastlogindate DATETIME
)";
mysqli_query($conn, $table_query) or die("Table creation error: " . mysqli_error($conn));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usrid = trim($_POST['usrid']);
    $usrpswd = trim($_POST['usrpswd']);
    $usrname = trim($_POST['usrname']);
    $usremail = trim($_POST['usremail']);
    $usrtype = strtoupper(trim($_POST['usrtype']));

    // Validation
    if (strlen($usrid) < 4) {
        $errors[] = "User ID must be at least 4 characters.";
    }

    if (!preg_match('/^[A-Z][A-Za-z0-9]{4,}$/', $usrpswd)) {
        $errors[] = "Password must start with a capital letter and be at least 5 characters.";
    }

    if (!in_array($usrtype, ['A', 'N'])) {
        $errors[] = "User Type must be either 'A' (Admin) or 'N' (Normal).";
    }

    if (!filter_var($usremail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {
        // Hash the password securely
        $hashed_password = password_hash($usrpswd, PASSWORD_DEFAULT);

        // Use prepared statements to insert safely
        $stmt = $conn->prepare("INSERT INTO usrdt (usrid, usrpswd, usrname, usremail, usrtype, usrlastlogindate) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $usrid, $hashed_password, $usrname, $usremail, $usrtype);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Database Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

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

<form method="POST" action="">
    <table>
        <tr>
            <td><label for="usrid">User ID:</label></td>
            <td><input type="text" name="usrid" id="usrid" value="<?= htmlspecialchars($_POST['usrid'] ?? '') ?>" required></td>
        </tr>
        <tr>
            <td><label for="usrpswd">Password:</label></td>
            <td><input type="password" name="usrpswd" id="usrpswd" required></td>
        </tr>
        <tr>
            <td><label for="usrname">Full Name:</label></td>
            <td><input type="text" name="usrname" id="usrname" value="<?= htmlspecialchars($_POST['usrname'] ?? '') ?>" required></td>
        </tr>
        <tr>
            <td><label for="usremail">Email:</label></td>
            <td><input type="email" name="usremail" id="usremail" value="<?= htmlspecialchars($_POST['usremail'] ?? '') ?>" required></td>
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
