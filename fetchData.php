<?php

// fetch all users from the database
function fetchUsers($connection){
    $query = mysqli_query($connection,"SELECT * FROM `users`");
    return mysqli_fetch_all($query,MYSQLI_ASSOC);
}

// fetch a single user from the database using their ID
function fetchUser($connection, $id){
    $id = mysqli_real_escape_string($connection,$id);
    $query = mysqli_query($connection,"SELECT * FROM `users` WHERE `id`= '$id'");
    $data = mysqli_fetch_assoc($query);
    if(!count($data)){
        header('Location: index.php');
        exit;
    }
    return $data;
}

?>