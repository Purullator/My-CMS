<?php

if (isset($_POST['create_user'])) {

    // $user_id = $_POST['user_id'];


    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_password'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];



    // $post_date = date('d-m-y');


    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username,  
                      user_email,user_password, user_image)

             VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}',
                  '{$user_email}','{$user_pass}', '{$user_image}') ";

    $createUserQuery = $connection->query($query);
    confirmQuery($createUserQuery);


    echo "User Created: " . " " . "<a class='btn btn-primary' href='users.php'>View Users</a>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">
        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>

    </select>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>