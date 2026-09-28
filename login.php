<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Load existing students from the JSON file
    $students_file = __DIR__ . '/data/students.json';
    $students = [];
    if (file_exists($students_file)) {
        $students_json = file_get_contents($students_file);
        $students = json_decode($students_json, true) ?? [];
    }

    // Check if the email exists in the students array
    foreach ($students as $student) {
        if ($student['email'] === $email && password_verify($password, $student['password'])) {
            // Email and password match, set session variables
            session_start();
            $_SESSION['user_id'] = $student['id'];
            $_SESSION['full_name'] = $student['full_name'];
            $_SESSION['email'] = $student['email'];
            $_SESSION['profile_picture'] = $student['profile_picture'];

            // Redirect to dashboard or profile page
            header('Location: dashboard.php');
            exit;
        }
    }

    // If no match found, show an error message
    echo '<script>alert("Invalid email or password.");</script>';
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chidiadi's Student Management App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="height: 85vh;">
        <div class=" p-4 mt-5" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Login to Chidiadi's Student Management App</h3>

            <form action="login.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>


                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <p class="text-center text-muted mt-1">
                    New to the app? <a href="register.php">Create an account</a>
                </p>
            </form>
        </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>