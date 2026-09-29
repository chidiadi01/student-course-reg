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
    <title>Dashboard - Chidiadi's Student Management System</title>
    <?php include 'bootstrap.php'; ?>
</head>
</head>

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
                    echo '<li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>';
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

    <div class=" row" style="height: 80vh;">
        <div class="container ml-2 mt-4 text-left col-11 col-md-7">
            <h3>Welcome, <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest'; ?></h1>
        </div>
        <div class="d-flex justify-content-center align-items-center col-12 col-md-5">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Profile Details</h5>
                    <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="img-thumbnail mb-3" style="width: 150px; height: 150px;">
                    <p class="card-text text-left"><strong>Name:</strong> <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Not available'; ?> </p>
                    <p class="card-text text-left"><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Not available'; ?></p>
                    <p class="card-text text-left"><strong>Student ID:</strong> <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not available'; ?></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>