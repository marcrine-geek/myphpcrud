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
    <title>Registration</title>
</head>
<body>

<div class="container">
    <h1>Registration Form</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="index.php" method="post">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" placeholder="Enter your phone no." required>
                </div>
                <div>
                    <label for="address">Address</label>
                    <input type="address" name="address" placeholder="Enter your address" required>
                </div>
                <div>
                    <label for="speciality">Speciality</label>
                    <select name="speciality" id="speciality" required>
                        <option value="">--select--</option>
                        <option value="AI">Artificial Intelligence</option>
                        <option value="games">Game Design</option>
                        <option value="software">Programming Languages</option>
                        <option value="networks">Networks</option>
                        <option value="data">Data Science</option>
                    </select>
                </div>
                <?php if (isset($insert_data) && $insert_data !== true) {
                    echo '<p class="msg err-msg">' . $insert_data . '</p>';
                }
                ?>
                <div>
                    <input type="submit" value="submit">
                </div>

            </form>
        </div>
        <div class="col-md-7">
            <?php if (count($all_user) > 0) : ?>
                <table>
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Speciality</th>
                        <th>Action</th>
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
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $speciality; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $id; ?>" class="edit">Edit</a>&nbsp;|
                                <a href="delete.php?id=<?php echo $id; ?>" class="delete delete-action">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>No records found. Please insert some records.</h2>
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

</body>
</html>
