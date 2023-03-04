<table class="table table-border table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>

        </tr>
    </thead>

    <tbody>
        <?php

        $query = "SELECT * FROM comments";
        $selectComments = $connection->query($query);


        while ($row = mysqli_fetch_assoc($selectComments)) {

            $comm_id = $row['comment_id'];
            $comm_post_id = $row['comment_post_id'];
            $comm_author = $row['comment_author'];
            $comm_content = $row['comment_content'];
            $comm_email = $row['comment_email'];
            $comm_status = $row['comment_status'];
            $comm_date = $row['comment_date'];


            echo "<tr>";
            echo "<td>{$comm_id}</td>";
            echo "<td>{$comm_author}</td>";
            echo "<td>{$comm_content}</td>";


            //   $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            //   $selectCatId = $connection->query($query);


            //   while($row = mysqli_fetch_assoc($selectCatId)){

            //       $cat_id = $row['cat_id'];
            //       $cat_title = $row['cat_title']; 

            //       echo "<td>{$cat_title}</td>";
            //  }


            echo "<td>{$comm_email}</td>";
            echo "<td>{$comm_status}</td>";


            $query = "SELECT * FROM posts WHERE posts_id = $comm_post_id ";
            $selectPostIdQuery = $connection->query($query);
            while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {

                $post_id = $row['posts_id'];
                $post_title = $row['post_title'];

                echo "<td><a href ='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>{$comm_date}</td>";

            echo "<td><a href='comments.php?approve=$comm_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comm_id'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comm_id'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php

// Approve comment

if (isset($_GET['approve'])) {

    $approveCommId = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approveCommId ";

    $unapproveCommQuery = $connection->query($query);
    header("Location: comments.php");
}

//unapprove comment

if (isset($_GET['unapprove'])) {

    $unapproveCommId = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapproveCommId ";

    $unapproveCommQuery = $connection->query($query);
    header("Location: comments.php");
}

//delete comment

if (isset($_GET['delete'])) {

    $deleteCommId = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $deleteCommId ";

    $deleteQuery = $connection->query($query);
    header("Location: comments.php");
}

?>