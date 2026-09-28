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
    <title>Chidiadi's Student Management App</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">CSMA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php 
                if ($loggedIn) {
                    echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>';
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
    <div class="d-flex justify-content-center align-items-center row" style="height: 80vh;">
        <div class="container m-auto text-center col-11 col-md-7">
            <h1>Welcome to Chidiadi's Student Management App</h1>
            <p>This is a simple home page for my application. Here, you can view profiles,
                register courses, and view results. Get started here.</p>
            <a href="<?php echo $loggedIn ? 'dashboard.php' : 'register.php'; ?>">
                <button class="btn btn-primary"><?php echo $loggedIn ? 'Go to Dashboard' : 'Register'; ?></button>
            </a>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>