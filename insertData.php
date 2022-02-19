<?php

function insertData($connection, $name, $email, $phone, $address, $speciality)
{
    $name = trim(mysqli_real_escape_string($connection, htmlspecialchars($name)));
    $email = trim(mysqli_real_escape_string($connection, htmlspecialchars($email)));
    $phone = trim(mysqli_real_escape_string($connection, htmlspecialchars($phone)));
    $address = trim(mysqli_real_escape_string($connection, htmlspecialchars($address)));
    $speciality = trim(mysqli_real_escape_string($connection, htmlspecialchars($speciality)));

    // IF NAME OR EMAIL IS EMPTY
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($speciality)) {
        return 'Please fill all required fields.';
    }
    //IF EMAIL IS NOT VALID
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address.';
    } else {
        $check_email = mysqli_query($connection, "SELECT `email` FROM `users` WHERE `email` = '$email'");
        // IF THE EMAIL IS ALREADY IN USE
        if (mysqli_num_rows($check_email) > 0) {
            return 'This email is already registered. Please try another.';
        }

        // INSERTING THE USER DATA
        $query = mysqli_query($connection, "INSERT INTO `users`(`name`,`email`, `phone`, `address`, `speciality`) VALUES('$name','$email', '$phone', '$address', '$speciality')");
        // IF USER INSERTED
        if ($query) {
            return true;
        }
        return 'Opps something is going wrong!';
    }
}

?>
