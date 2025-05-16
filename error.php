<?php
switch ($_GET['ec']) {
    // login failure
    case 0:
    $message = "Your user name or password is incorrect!
    <a href=index.php>Please try again.</a>";
    break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
    $message = "There was an authentication error. Please
    <a href=index.php>log in</a> correctly.";
    break;

    // session problem - logging twice
    case 2:
    $message = "There was an authentication error. You should logout 
    first Please<a href=logout.php>logout or change the user</a>";
    break;

    // bad datestamp
    case 3:
    $message = "You selected an invalid date range. Please
    <a href=mnmnu.php>try again</a>";
    break;

    // missing permission
    case 4;
    $message = "You dont have permission. Please
    <a href=logout.php>log in</a> using admin account.";
    break;

    // default action
    default:
    $message = "There was an error performing the requested action. Please
    <a href=index.php>log in</a> again.";
    break; 
}
$pageTitle = "Error";
include('header.php');
echo "<form>\n";
echo "<h3 style='color:red;'>Could Not Login.</h3><p>\n";
echo $message;
echo "</form>\n";
include('footer.php');
?>