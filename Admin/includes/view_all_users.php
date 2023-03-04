<table class="table table-border table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>

    <tbody>
        <?php

        $query = "SELECT * FROM users";
        $selectUsers = $connection->query($query);


        while ($row = mysqli_fetch_assoc($selectUsers)) {

            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_pass = $row['user_password'];
            $user_firstName = $row['user_firstname'];
            $user_lastName = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstName}</td>";


            //   $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            //   $selectCatId = $connection->query($query);


            //   while($row = mysqli_fetch_assoc($selectCatId)){

            //       $cat_id = $row['cat_id'];
            //       $cat_title = $row['cat_title']; 

            //       echo "<td>{$cat_title}</td>";
            //  }

            echo "<td>{$user_lastName}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";


            // $query = "SELECT * FROM posts WHERE posts_id = $comm_post_id ";
            // $selectPostIdQuery = $connection->query($query);
            // while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {

            //     $post_id = $row['posts_id'];
            //     $post_title = $row['post_title'];

            //     echo "<td><a href ='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }

            echo "<td><a href='users.php?change_admin=$user_id'>Admin</a></td>";
            echo "<td><a href='users.php?change_sub=$user_id'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php

// Promote user to admin 

if (isset($_GET['change_admin'])) {

    $userId = $_GET['change_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $userId ";

    $changeToAdminQuery = $connection->query($query);
    header("Location: users.php");
}

//Demote user to subscriber

if (isset($_GET['change_sub'])) {

    $userId = $_GET['change_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $userId ";

    $changeToSubQuery = $connection->query($query);
    header("Location: users.php");
}

//Delete user

if (isset($_GET['delete'])) {

    $userId = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = $userId ";

    $deleteUserQuery = $connection->query($query);
    header("Location: users.php");
}

?>