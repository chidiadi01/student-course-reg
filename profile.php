<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}   

$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Chidiadi's Student Management System</title>
   <?php include 'bootstrap.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">CSMA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                 <?php 
                if ($loggedIn) {
                    echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    echo '<li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="results.php">Results</a></li>';
                } else {
                    echo '';
                }                
                ?>
                <li> <a class="d-inline-block d-lg-none" href="<?php echo $loggedIn ? 'logout.php' : 'login.php'; ?>">
                        <button class="btn btn-outline-primary"><?php echo $loggedIn ? 'Logout' : 'Login'; ?></button>
                    </a>
                </li>

            </ul>
        </div>

        <a class="ml-auto d-none d-lg-inline-block" href="<?php echo $loggedIn ? 'logout.php' : 'login.php'; ?>">
            <button class="btn btn-outline-primary"><?php echo $loggedIn ? 'Logout' : 'Login'; ?></button>
        </a>

    </nav>

</body>

</html>
<!-- 9. PROFILE – profile.php

Display the student's:

* Full Name
* Email
* Age
* Department
* Level
* Profile Picture

-->