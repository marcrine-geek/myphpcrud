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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user's details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        label{
            display: inline-block;
            width: 100px;
        }
    </style>
</head>

<body>


<div class="container" style="padding-top: 150px; padding-left: 300px; ">
    <div class="row">
        <div class="col-md-8" style="background-color: darkblue; width: 40%; border: 2px solid black; border-radius: 10px;">
            <form action="" method="post" style="text-align: center;">
                <h2 style="color: white; padding-top: 15px;">Update <?php echo htmlspecialchars($theUser['name']); ?> Details.</h2>
                <div style="padding: 15px; color: white;">
                    <label for="userName">Full Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($theUser['name']); ?>" id="userName" placeholder="Name" autocomplete="off" required>
                </div>

                <div style="padding: 15px; color: white;">
                    <label for="userEmail">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($theUser['email']); ?>" id="userEmail" placeholder="Email" autocomplete="off" required>
                </div>

                <div style="padding: 15px; color: white;">
                    <label for="phone">phone</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($theUser['phone']); ?>" id="userName" placeholder="phone" autocomplete="off" required>
                </div>

                <div style="padding: 15px; color: white;">
                    <label for="address">address</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($theUser['address']); ?>" id="address" placeholder="address" autocomplete="off" required>
                </div>

                <div style="padding: 15px; color: white;">
                    <label for="speciality">speciality</label>
                    <select name="speciality" value="<?php echo htmlspecialchars($theUser['speciality']); ?>" id="speciality" placeholder="speciality" autocomplete="off" required>
                        <option value="">--select--</option>
                        <option value="AI">Artificial Intelligence</option>
                        <option value="game design">Game Design</option>
                        <option value="software engineer">Programming Languages</option>
                        <option value="networks">Networks</option>
                        <option value="data science">Data Science</option>
                    </select>
                </div>

                <?php if (isset($update_data) && $update_data !== true) {
                    echo '<p class="msg err-msg">' . $update_data . '</p>';
                }
                ?>
                <div style="padding: 15px;">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

