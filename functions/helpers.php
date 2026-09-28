<?php

function password_validator(string $password): bool
{

    $has_upper_case = false;
    $has_lower_case = false;
    $has_number = false;
    $has_special_character = false;

    //Check length

    if (strlen($password) < 8) {
        return false;
    }

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];

        //Check upper case
        if (ctype_upper($char)) {
            $has_upper_case = true;

            //Check for lower case
        } elseif (ctype_lower($char)) {
            $has_lower_case = true;

            // Check if it is a number
        } elseif (ctype_digit($char)) {
            $has_number = true;
        } else {
            $has_special_character = true;
        }
    }

    return $has_lower_case &&
        $has_upper_case &&
        $has_number &&
        $has_special_character;
}

function logout_user() {
    // Start the session if it hasn't been started yet
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to the home page
    header('Location: index.php');
    exit;
}