<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->

<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">


      <?php



      if (isset($_GET['category'])) {

        $post_category_id = $_GET['category'];
      }

      $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id ";
      $postResult = $connection->query($query);

      while ($row = mysqli_fetch_assoc($postResult)) {

        $post_id = $row['posts_id'];
        $post_title = $row['post_title'];
        $post_autor = $row['post_autor'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 100);
      ?>

        <h1 class="page-header">
          Page Heading
          <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
          <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
        </h2>
        <p class="lead">
          by <a href="index.php"><?= $post_autor ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
        <hr>
        <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
        <hr>
        <p><?= $post_content ?></p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
      <?php
      }
      ?>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>

  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php"; ?>