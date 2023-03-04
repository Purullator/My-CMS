<form action="" method="post">
  <div class="form-group">
    <label for="cat_title">Edit Category</label>

    <?php

    if (isset($_GET['edit'])) {
      $cat_id = $_GET['edit'];
      $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
      $selectCatId = $connection->query($query);


      while ($row = mysqli_fetch_assoc($selectCatId)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
      }
    ?>

      <input value="<?php if (isset($cat_title)) {
                      echo $cat_title;
                    } ?>" class="form-control" type="text" name="cat_title">

    <?php
    }
    ?>

    <?php

    if (isset($_POST['cat_title'])) {

      $thecattitle = $_POST['cat_title'];

      $query = "UPDATE categories SET cat_title = '{$thecattitle}' WHERE cat_id = $cat_id";
      $updateQuery = $connection->query($query);
    }
    ?>

  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update">
  </div>


</form>