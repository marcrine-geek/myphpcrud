<?php

require_once './connection.php';
require_once './fetchData.php';
require_once './update.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['speciality'])) {

    $update_data = updateUser($connection, $_GET['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['speciality']);

    if ($update_data === true) {
        header('Location: index.php');
        exit;
    }
}

$theUser = fetchUser($connection, $_GET['id']);


?>

<h1>hELLO EDIT</h1>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user's details</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

<h1>This is edit page</h1>

<div class="container">
    <header class="header">

    </header>
    <div class="wrapper edit-wrapper">
        <div class="form">
            <form action="" method="post">
                <label for="userName">Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($theUser['name']); ?>" id="userName" placeholder="Name" autocomplete="off" required>
                <label for="userEmail">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($theUser['email']); ?>" id="userEmail" placeholder="Email" autocomplete="off" required>
                <label for="phone">phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($theUser['phone']); ?>" id="userName" placeholder="phone" autocomplete="off" required>
                <label for="address">address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($theUser['address']); ?>" id="address" placeholder="address" autocomplete="off" required>
                <label for="speciality">speciality</label>
                <input type="text" name="speciality" value="<?php echo htmlspecialchars($theUser['speciality']); ?>" id="speciality" placeholder="speciality" autocomplete="off" required>
                <?php if (isset($update_data) && $update_data !== true) {
                    echo '<p class="msg err-msg">' . $update_data . '</p>';
                }
                ?>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</div>

</body>

</html>

