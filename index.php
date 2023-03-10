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

      $per_page = 5;

      if (isset($_GET['page'])) {

        $page = $_GET['page'];
      } else {
        $page = "";
      }
      if ($page == "" || $page == 1) {
        $page_1 = 0;
      } else {
        $page_1 = ($page * $per_page) - $per_page;
      }


      $post_query_count = "SELECT * FROM posts";
      $find_count = $connection->query($post_query_count);
      $count = mysqli_num_rows($find_count);
      $count = ceil($count / $per_page);

      $query = "SELECT * FROM posts ORDER BY posts_id DESC LIMIT $page_1, $per_page";
      $postResult = $connection->query($query);

      while ($row = mysqli_fetch_assoc($postResult)) {

        $post_id = $row['posts_id'];
        $post_title = $row['post_title'];
        $post_autor = $row['post_autor'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 100);
        $post_status = $row['post_status'];

        if ($post_status === 'published') {


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
            by <a href="author_posts.php?autor=<?= $post_autor ?>&p_id=<?= $post_id ?>"><?= $post_autor ?></a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
          <hr>
          <a href="post.php?p_id=<?= $post_id ?>">
            <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
          </a>
          <hr>
          <p><?= $post_content ?></p>
          <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

          <hr>
      <?php

        }
      }
      ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>

  </div>
  <!-- /.row -->

  <hr>

  <ul class="pager">
    <?php

    for ($i = 1; $i <= $count; $i++) {

      if ($i == $page) {

        echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
      } else {

        echo "<li><a href='index.php?page=$i'>$i</a></li>";
      }
    }
    ?>
  </ul>

  <?php include "includes/footer.php"; ?>