<?php

if (isset($_GET['edit_user'])) {

    $userId = $_GET['edit_user'];


    $query = "SELECT * FROM users WHERE user_id = $userId ";
    $selectUsersQuery = $connection->query($query);


    while ($row = mysqli_fetch_assoc($selectUsersQuery)) {

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_pass = $row['user_password'];
        $user_firstName = $row['user_firstname'];
        $user_lastName = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])) {


    $user_firstName = $_POST['user_firstname'];
    $user_lastName = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_password'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];


    $query = "SELECT randSalt FROM users";
    $selectRandSaltQuery = $connection->query($query);
    if (!$selectRandSaltQuery) {
        die("Query Failed" . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($selectRandSaltQuery);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_pass, $salt);


    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {

        $query = "SELECT * FROM users WHERE user_id = $userId ";
        $select_image = $connection->query($query);

        while ($row = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    $query = "UPDATE users SET user_firstname = '{$user_firstName}',
                         user_lastname = '{$user_lastName}',
                         user_role = '{$user_role}',
                         username = '{$username}',
                         user_email = '{$user_email}',
                         user_password = '{$hashed_password}',
                         user_image = '{$user_image}' 

                     WHERE user_id = {$userId} ";


    $update_user = $connection->query($query);
    confirmQuery($update_user);
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" value="<?= $user_firstName ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_status">Lastname</label>
        <input type="text" value="<?= $user_lastName ?>" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">

        <option value="<?= $user_role ?>"><?= $user_role ?></option>

        <?php
        if ($user_role == 'admin') {
            echo "<option value='subscriber'>subscriber</option>";
        } else {
            echo "<option value='admin'>admin</option>";
        }

        ?>
    </select>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?= $username ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image" value="<?= $user_image ?>">
        <img width="100" src="../images/<?= $user_image ?>" alt="">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?= $user_email ?>" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" value="<?= $user_pass ?>" class="form-control">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>