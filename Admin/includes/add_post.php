<?php

if (isset($_POST['create_post'])) {

    $post_title = $_POST['title'];
    $post_autor = $_POST['autor'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_content = mysqli_real_escape_string($connection, $post_content);


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_autor, post_date, 
                      post_image,post_content,post_tags,post_status)

          VALUES ({$post_category_id},'{$post_title}','{$post_autor}',now(),
                  '{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $createPostQuery = $connection->query($query);
    confirmQuery($createPostQuery);
    $postId = mysqli_insert_id($connection);

    echo "<p class='bg-success'>POST Created. If you want to see the created Post, 
    
    go to <a class='btn btn-success' href='../post.php?p_id=$postId'>View Post <span class='glyphicon glyphicon-chevron-right'></span></a> 
    
    or to continue editing,  <a class ='btn btn-primary' href='posts.php?source=add_post'>Create More Posts</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category" id="post_category">
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
        <input type="text" class="form-control" name="autor">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" accept="image/*">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><p></p></textarea>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>