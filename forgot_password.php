<?php
include('dbconnect.php');
include('header.php');
echo '<div id="topLinks">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="register.php">REGISTER</a></li>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newpass = $_POST['newpass'] ?? '';
    $errors = [];

    // Check if email exists
    $check_query = "SELECT * FROM usrdt WHERE usremail = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        if (!empty($newpass)) {

            if (!preg_match('/^[A-Z][A-Za-z0-9]{4,}$/', $newpass)) {
                $errors[] = "Password must start with a capital letter and be at least 5 characters.";
            }

            if (empty($errors)) {
                // Update password
                $update_query = "UPDATE usrdt SET usrpswd = '$newpass' WHERE usremail = '$email'";
                if (mysqli_query($conn, $update_query)) {
                    // Redirect to login page after success
                    header("Location: index.php?reset=success");
                    exit;
                } else {
                    echo "<p style='color:red;'>Error updating password: " . mysqli_error($conn) . "</p>";
                }
            } else {
                foreach ($errors as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }

                // show the password form again
                echo <<<FORM
                    <h2>Reset Password</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="email" value="$email">
                        <label>Enter New Password:</label>
                        <input type="password" name="newpass" required>
                        <input type="submit" value="Update Password">
                    </form>
                FORM;
            }

        } else {
            // form to enter new password
            echo <<<FORM
                <h2>Reset Password</h2>
                <form method="POST" action="">
                    <input type="hidden" name="email" value="$email">
                    <label>Enter New Password:</label>
                    <input type="password" name="newpass" required>
                    <input type="submit" value="Update Password">
                </form>
            FORM;
        }
    } else {
        echo "<p style='color:red;'>Email not found.</p>";
    }
}

// Initial form 
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['email']) || (isset($_POST['newpass']) && empty($_POST['newpass']))) {
    echo <<<FORM
        <h2>Forgot Password</h2>
        <form method="POST" action="">
            <label>Enter your registered email:</label>
            <input type="email" name="email" required>
            <input type="submit" value="Next">
        </form>
    FORM;
}

include('footer.php');
?>
