<?php

function updateUser($connection, $id, $name, $email, $phone, $address, $speciality)
{

    $id = trim(mysqli_real_escape_string($connection, $id));
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
        // update existing user
        $query = mysqli_query($connection, "UPDATE `users` SET `name`='$name', `email`='$email', `phone`='$phone', `address`='$address', `speciality`='$speciality' WHERE `id`='$id'");
        // is user is updated
        if ($query) {
            return true;
        }
        return 'Opps something is going wrong!';
    }
}

?>