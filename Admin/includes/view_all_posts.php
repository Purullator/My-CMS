<?php


if (isset($_POST['checkBoxArray'])) {


    foreach ($_POST['checkBoxArray'] as $postValueId) {

        $bulk_options = $_POST['bulk_options'];


        switch ($bulk_options) {

            case 'published':

                $query = "UPDATE posts SET post_status = '$bulk_options' 
                           WHERE posts_id = $postValueId";
                $updateToPublStatus = $connection->query($query);
                confirmQuery($updateToPublStatus);

                break;

            case 'draft':

                $query = "UPDATE posts SET post_status = '$bulk_options' 
                          WHERE posts_id = $postValueId";
                $updateToDraftlStatus = $connection->query($query);

                break;

            case 'delete':

                $query = "DELETE FROM posts 
                          WHERE posts_id = $postValueId";
                $updateToDelStatus = $connection->query($query);

                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE posts_id = '$postValueId'";
                $selectPostQuery = $connection->query($query);

                while ($row = mysqli_fetch_array($selectPostQuery)) {


                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_autor = $row['post_autor'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_content = mysqli_real_escape_string($connection, $post_content);
                }


                $query = "INSERT INTO posts(post_category_id, post_title, post_autor, post_date, 
                                            post_image, post_content, post_tags, post_status) 
                               VALUES($post_category_id, '$post_title', '$post_autor', now(),
                                     '$post_image', '$post_content','$post_tags','$post_status')";
                $copy_query = $connection->query($query);

                if (!$copy_query) {
                    die("Query Failed" . $connection->error_log());
                }

                break;
        }
    }
}


?>

<form action="" method="POST">

    <table class="table table-border table-hover">


        <div id="bulkOptionsContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>View Count</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $query = "SELECT * FROM posts ORDER BY posts_id DESC";
            $selectPost = $connection->query($query);


            while ($row = mysqli_fetch_assoc($selectPost)) {

                $post_id = $row['posts_id'];
                $post_autor = $row['post_autor'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_counts = $row['post_views_counts'];
                // $post_content = $row['post_content'];

                echo "<tr>";

            ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?= $post_id ?>'></td>


            <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_autor}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";


                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                $selectCatId = $connection->query($query);


                while ($row = mysqli_fetch_assoc($selectCatId)) {

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                }


                echo "<td>{$cat_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}'</td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                // echo "<td>{$post_content}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td>$post_views_counts</td>";
                echo "</tr>";
            }

            ?>







        </tbody>
    </table>
</form>

<?php

if (isset($_GET['delete'])) {

    $deletePostId = $_GET['delete'];

    $query = "DELETE FROM posts WHERE posts_id={$deletePostId} ";

    $deleteQuery = $connection->query($query);
    header("Location: posts.php");
}

?>