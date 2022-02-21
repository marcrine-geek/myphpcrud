<?php

require_once './connection.php';
require_once './fetchData.php';
require_once './insertData.php';
$all_user = array_reverse(fetchUsers($connection));

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['speciality'])) {
    $insert_data = insertData($connection, $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['speciality']);
    if ($insert_data === true) {
        header('Location: index.php');
        exit;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        label{
            display: inline-block;
            width: 100px;
            text-align: center;
        }
    </style>
    <title>Registration</title>
</head>
<body>

<div class="container" style="padding-top: 60px;">

    <div class="row">
        <div class="col-md-5" style="background-color: black; border-radius: 10px; width: 40%;">
            <form action="index.php" method="post" style="padding-top: 30px; color: white;">
                <h1 style="text-align: center;">Registration Form</h1>
                <div style="padding: 20px;">
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div style="padding: 20px;">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div style="padding: 20px;">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" placeholder="Enter your phone no." required>
                </div>
                <div style="padding: 20px;">
                    <label for="address">Address</label>
                    <input type="address" name="address" placeholder="Enter your address" required>
                </div>
                <div style="padding: 20px;">
                    <label for="speciality">Speciality</label>
                    <select name="speciality" id="speciality" required>
                        <option value="">--select--</option>
                        <option value="AI">Artificial Intelligence</option>
                        <option value="game design">Game Design</option>
                        <option value="software engineer">Programming Languages</option>
                        <option value="networks">Networks</option>
                        <option value="data science">Data Science</option>
                    </select>
                </div>
                <?php if (isset($insert_data) && $insert_data !== true) {
                    echo '<p class="msg err-msg">' . $insert_data . '</p>';
                }
                ?>
                <div style="padding: 20px;">
                    <input type="submit" value="submit" class="btn btn-primary">
                </div>

            </form>
        </div>
        <div class="col-md-7">
            <?php if (count($all_user) > 0) : ?>
                <table style="padding-top: 30px; background-color: orange; border: 2px solid black;">
                    <tbody>
                    <tr style="padding: 20px;">
                        <th style="padding: 15px;">Name</th>
                        <th style="padding: 15px;">Email</th>
                        <th style="padding: 15px;">Phone</th>
                        <th style="padding: 15px;">Address</th>
                        <th style="padding: 15px;">Speciality</th>
                        <th style="padding: 15px;">Action</th>
                    </tr>
                    <?php foreach ($all_user as $user) :
                        $id = $user['id'];
                        $name = $user['name'];
                        $email = $user['email'];
                        $phone = $user['phone'];
                        $address = $user['address'];
                        $speciality = $user['speciality'];
                        ?>
                        <tr>
                            <td align="center" style="padding: 15px;"><?php echo $name; ?></td>
                            <td align="center" style="padding: 15px;"><?php echo $email; ?></td>
                            <td align="center" style="padding: 15px;"><?php echo $phone; ?></td>
                            <td align="center" style="padding: 15px;"><?php echo $address; ?></td>
                            <td align="center" style="padding: 15px;"><?php echo $speciality; ?></td>
                            <td align="center" style="padding: 15px;">
                                <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-primary">Edit</a>&nbsp;|
                                <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2 style="text-align: center; color: darkblue;">Please insert some records.</h2>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    var delteAction = document.querySelectorAll('.delete-action');
    delteAction.forEach((el) => {
        el.onclick = function(e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                window.location.href = e.target.href;
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
