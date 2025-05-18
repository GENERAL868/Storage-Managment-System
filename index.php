<?php 
$pageTitle = 'Login';
include('header.php');
?>

<h1 style="text-align: center;">Inventory Management System</h1>



<!--message after password reset -->
<?php if (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
    <p style="color: green; text-align: center;">Password updated successfully. You can now log in.</p>
<?php endif; ?>

<!-- Login Form -->
<form action="login.php" method="post">
    <table>
        <tr>
            <th colspan="2" style="text-align: center;">Login Page</th>
        </tr>
        <tr>
            <td>User ID</td>
            <td><input type="text" name="userid" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="Login"> 
                <input type="reset" value="Clear">
            </td>
        </tr>
    </table>
    <p style="text-align: center;">Don't have an account? <a href="register.php">Register here</a></p>
    <p style="text-align: center;"><a href="forgot_password.php">Forgot Password?</a></p>
</form>

<?php include('footer.php'); ?>
