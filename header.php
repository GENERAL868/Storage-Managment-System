<html>

<head >
    <title><?php echo $pageTitle ?></title>
    <link href='style.css' rel='stylesheet'>
    <link href='icon.png' rel='icon'>
    <style>
        
    </style>
</head>

<body>
<section id='container'>
<header>
    <section class='orgName'>Storage Managment System</section>
    <section class='cDate'><?php echo date("l, j/n/Y"); ?></section>
</header>
    <section id='userBar'>
        <?php
            // session_start();
            if (isset($_SESSION['UID'])) {
                $UserTypes = ['A'=>'Admin', 'N'=>'Normal'];
                echo "<div>{$_SESSION['NAME']} <i>({$UserTypes[$_SESSION['TYPE']]})</i> | <a href='logout.php'>Logout</a></div>"; 
                //if (isset($_COOKIE['uid'])) { echo "[".$_COOKIE['uid'] ."]" .$_COOKIE['name'];} else echo "***";
            } else {
                $logInForm = "
                <div>
                Log in <form action='login.php' method='post' style='display:inline;'>
                <input type='text' name='uid' size='10' placeholder='User Id'>
                <input type='password' name='pswd' size='10' placeholder='Password'>
                <input type='submit' name='submit' value='Login'></form>
                </div>
                ";
                // echo $logInForm;
            }
        ?>
    </section>  <!-- end of user bar section -->
    <section id='topLinks'>
        <ul>
            <!--  <li><a href='../'>Home</a></li> -->
        </ul>
    </section> <!-- end of topLinks section -->
<section class=content>
<?php $mo="<mark>"; $mc="</mark>"; ?>
