<?php
require_once 'functions/helpers.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Chidiadi's Student Management App</title>
    <?php include 'bootstrap.php'; ?>
</head>

<body>

    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: 85vh;">
            <div class=" p-4 mt-5" style="width: 100%; max-width: 400px;">
                <h3 class="text-center mb-4">Sign up for Chidiadi's Student Management App</h3>

                <form action="register.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <input type="number" name="age" class="form-control" placeholder="Age">
                    </div>

                    <div class="form-group">
                        <input type="text" name="department" class="form-control" placeholder="Department" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="level" class="form-control" placeholder="Level">
                    </div>

                    <div class="form-group">
                        <label class="d-block">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <p class="text-center text-muted mt-1">
                        Already have an account? <a href="login.php">Login here</a>
                    </p>
                </form>
            </div>

            <?php
            $form_data = $_POST;
            if (!empty($form_data)) {
                $full_name = $form_data['full_name'];
                $email = $form_data['email'];
                $password = password_hash($form_data['password'], PASSWORD_DEFAULT);
                $age = $form_data['age'];
                $department = $form_data['department'];
                $level = $form_data['level'];

                $validation_passed = false;

                $validate_name = false;
                $validate_email = false;
                $validate_password = false;
                $validate_age = false;
                $validate_level = false;
                $validate_picture = false;

                //Validate full name to be at least 3 characters long

                if (strlen($full_name) >= 3) {
                    $validate_name = true;
                } else {
                    echo '<script>alert("Full Name must be at least 3 characters long.");</script>';
                }

                //Validate email using PHP's filter_var function with FILTER_VALIDATE_EMAIL

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $validate_email = true;
                } else {
                    echo '<script>alert("Invalid email address.");</script>';
                }

                //Validate password to be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one special character

                if (password_validator($form_data['password'])) {
                    $validate_password = true;
                } else {
                    echo '<script>alert("Password must meet the required criteria.");</script>';
                }

                //Validate age to be between 16 and 40

                if (16 <= $age && $age <= 40) {
                    $validate_age = true;
                } else {
                    echo '<script>alert("Age must be between 16 and 40.");</script>';
                }

                //Validate level to be one of the following: 100, 200, 300, 400, 500

                switch ($level) {
                    case '100':
                    case '200':
                    case '300':
                    case '400':
                    case '500':
                        $validate_level = true;
                        break;
                    default:
                        echo '<script>alert("Level must be one of the following: 100, 200, 300, 400, 500.");</script>';
                }

                // Validate profile picture

                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {

                    $allowed_types = ['image/jpeg', 'image/png'];
                    $allowed_extensions = ['jpg', 'jpeg', 'png'];
                    $max_size = 2 * 1024 * 1024; // 2MB in bytes

                    $file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
                    $file_mime = mime_content_type($_FILES['profile_picture']['tmp_name']);
                    $file_size = $_FILES['profile_picture']['size'];

                    if (!in_array($file_ext, $allowed_extensions) || !in_array($file_mime, $allowed_types)) {
                        echo '<script>alert("Profile picture must be a JPG, JPEG, or PNG image.");</script>';
                    } elseif ($file_size > $max_size) {
                        echo '<script>alert("Profile picture must be no larger than 2MB.");</script>';
                    } else {
                        $validate_picture = true;
                    }
                } else {
                    // No file uploaded — decide if this is required or optional
                    echo '<script>alert("Please upload a profile picture.");</script>';
                }

                //If all validations pass, set the validation_passed flag to true

                if ($validate_name && $validate_email && $validate_password && $validate_age && $validate_level && $validate_picture) {
                    $validation_passed = true;
                }

                //If validation passed, upload the profile picture and save the user data to a file

                if ($validation_passed) {
                    // Handle profile picture upload
                    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                        $upload_dir = 'uploads/';
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0755, true);
                        }
                        $new_name = 'usr_img_' . bin2hex(random_bytes(8)) . '.' . pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
                        $profile_picture_path = $upload_dir . $new_name;
                        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_path);
                    } else {
                        $profile_picture_path = null; // No profile picture uploaded
                    }

                    //CHECK THESE 
                    /*  echo "Filename: " . $_FILES['profile_picture']['name'] . "<br>";
                    echo "Type : " . $_FILES['profile_picture']['type'] . "<br>";
                    echo "Size : " . $_FILES['profile_picture']['size'] . "<br>";
                    echo "Temp name: " . $_FILES['profile_picture']['tmp_name'] . "<br>";
                    echo "Error : " . $_FILES['profile_picture']['error'] . "<br>"; */



                    // Save user data to a file 
                    $user_data = [
                        'id' => 'stu_' . bin2hex(random_bytes(8)),
                        'full_name' => trim($full_name),
                        'email' => $email,
                        'password' => $password,
                        'age' => $age,
                        'department' => $department,
                        'level' => $level,
                        'profile_picture' => $profile_picture_path
                    ];

                    $students_file = __DIR__ . '/data/students.json';

                    $students = [];
                    if (file_exists($students_file)) {
                        $students_json = file_get_contents($students_file);


                        $students = json_decode($students_json, true) ?? [];
                    }
                    array_push($students, $user_data);
                    file_put_contents($students_file, json_encode($students, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);

                    echo '<script>alert("Registration successful!");</script>';
                }
            }



            ?>
        </div>





    </body>

</html>