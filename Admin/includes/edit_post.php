<?php

if (isset($_GET['p_id'])) {

    $postId = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE posts_id = $postId ";
$selectPostById = $connection->query($query);


while ($row = mysqli_fetch_assoc($selectPostById)) {

    $post_id = $row['posts_id'];
    $post_autor = $row['post_autor'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    $post_views_counts = $row['post_views_counts'];
}
if (isset($_POST['reset_views_counts'])) {

    $query = "UPDATE posts SET post_views_counts = 0 
                        WHERE posts_id = $post_id";
    $resetViews = $connection->query($query);
    if (!$resetViews) {
        die("Query Failed" . $connection->error_log());
    }
    header("Location: posts.php?source=edit_post&p_id=$post_id");
}

if (isset($_POST['update_post'])) {


    $post_autor = $_POST['autor'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_content = mysqli_real_escape_string($connection, $post_content);



    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {

        $query = "SELECT * FROM posts WHERE posts_id = $postId ";
        $select_image = $connection->query($query);

        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET post_title = '{$post_title}',
                         post_category_id = '{$post_category_id}',
                         post_date = now(),
                         post_autor = '{$post_autor}',
                         post_status = '{$post_status}',
                         post_tags = '{$post_tags}',
                         post_content = '{$post_content}',
                         post_image = '{$post_image}' 

                     WHERE posts_id = {$postId} ";

    $update_post = $connection->query($query);
    confirmQuery($update_post);

    echo "<p class='bg-success'>POST Updated. If you want to see the updated Post, 
    
    go to <a class='btn btn-success' href='../post.php?p_id=$postId'>View Post <span class='glyphicon glyphicon-chevron-right'></span></a> 
    
     or to continue editing,  <a class ='btn btn-primary' href='posts.php'>Edit More Posts</a></p>";
}
?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category" id="post_category" value="<?= $post_category_id ?>">
            <?php

            $query = "SELECT * FROM categories";
            $selectCat = $connection->query($query);
            confirmQuery($selectCat);

            while ($row = mysqli_fetch_assoc($selectCat)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                $selected = ($cat_id == $post_category_id) ? 'selected' : '';
                echo "<option value='$cat_id' $selected>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="autor">Author</label>
        <input value="<?= $post_autor ?>" type="text" class="form-control" name="autor">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value='<?= $post_status ?>'><?= $post_status ?></option>

            <?php if ($post_status == 'published') {

                echo "<option value='draft'>Draft</option>";
            } else {

                echo "<option value='published'>Published</option>";
            }
            ?>

        </select>
    </div>


    <div class="form-group">
        <input type="file" name="post_image">
        <img width="100" src="../images/<?= $post_image ?>" alt="">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?= $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="resetCount">Current Post Views : <a class="btn btn-success"><?= $post_views_counts ?> </a></label>
        <label for="reset_views_counts"> Reset views : </label>
        <input class="btn btn-primary" type="submit" value="Reset" name="reset_views_counts">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?= mysqli_real_escape_string($connection, $post_content);  ?></textarea>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>